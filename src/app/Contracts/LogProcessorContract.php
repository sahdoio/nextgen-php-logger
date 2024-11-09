<?php

namespace App\Contracts;

interface LogProcessorContract
{
    function exec(string $message): void;
    function setStrategy(LoggerStrategyContract $strategy): void;
}
