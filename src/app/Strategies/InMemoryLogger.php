<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyContract;
use App\Enums\LogLevel;

class InMemoryLogger implements LoggerStrategyContract
{
    public function handle(string $message, LogLevel $level): void
    {
        echo "[In Memory] {$level->value}: $message\n";
    }
}