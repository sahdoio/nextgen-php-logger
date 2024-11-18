<?php

namespace App\Contracts;

use App\Enums\LogLevel;

interface LoggerStrategyContract
{
    function handle(string $message, LogLevel $level): void;
}
