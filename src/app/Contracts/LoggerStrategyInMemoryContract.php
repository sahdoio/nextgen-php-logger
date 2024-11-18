<?php

namespace App\Contracts;

interface LoggerStrategyInMemoryContract extends LoggerStrategyContract
{
    function getLogs(): array;
    function getLastLog(): ?string;
}
