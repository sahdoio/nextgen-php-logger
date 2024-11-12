<?php

namespace App\Contracts;

use App\Enums\LogLevel;

interface LoggerStrategyContract
{
    public function handle(string $message, LogLevel $level): void;
}
