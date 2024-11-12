<?php

namespace App\Contracts;

use App\Enums\LogLevel;

interface LogProcessorContract
{
    function exec(string $message, LogLevel $level): void;
    function setStrategy(LoggerStrategyContract $strategy): void;
    function getStrategy(): LoggerStrategyContract;
}
