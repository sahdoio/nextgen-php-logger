<?php

namespace App\Strategies;

use App\Contracts\FileHandlerContract;
use App\Contracts\LoggerStrategyContract;
use App\Enums\LogLevel;
use Psr\Clock\ClockInterface;
use RuntimeException;

class FileLogger implements LoggerStrategyContract
{
    public function __construct(
        protected ?string $logFile,
        protected ClockInterface $clock,
        protected FileHandlerContract $fileHandler
    )
    {
        $this->logFile = $logFile ?? (ROOT_DIR . '/logs/app.log');
    }

    /**
     * @throws RuntimeException
     */
    public function handle(string $message, LogLevel $level): void
    {
        $formattedMessage = "[{$this->clock->now()->format('Y-m-d H:i:s')}][{$level->value}] $message";
        $this->fileHandler->open($this->logFile, 'a');
        $this->fileHandler->write($formattedMessage . PHP_EOL);
        $this->fileHandler->close();
    }
}
