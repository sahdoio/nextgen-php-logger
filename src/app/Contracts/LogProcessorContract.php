<?php

namespace App\Contracts;

use App\Enums\LogLevel;

interface LogProcessorContract
{
    function exec(string $message, LogLevel $level): void;
    function getStrategy(): LoggerStrategyContract;
}
