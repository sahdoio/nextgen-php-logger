<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyInMemoryContract;
use App\Enums\LogLevel;
use Psr\Clock\ClockInterface;

class InMemoryLogger implements LoggerStrategyInMemoryContract
{
    public function __construct(protected ClockInterface $clock)
    {
    }

    private array $logs = [];

    public function handle(string $message, LogLevel $level): void
    {
        $formattedMessage = "[{$this->clock->now()->format('Y-m-d H:i:s')}][{$level->value}] $message";
        $this->logs[] = $formattedMessage;
    }

    public function getLogs(): array
    {
        return $this->logs;
    }

    public function getLastLog(): ?string
    {
        return end($this->logs) ?: null;
    }
}
