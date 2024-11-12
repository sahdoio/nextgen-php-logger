<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyContract;
use App\Enums\LogLevel;

class DatabaseLogger implements LoggerStrategyContract
{
    public function handle(string $message, LogLevel $level): void
    {
        echo "[Database] {$level->value}: $message\n";
    }
}
