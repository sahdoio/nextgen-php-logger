<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyContract;

class FileLogger implements LoggerStrategyContract
{
    public function handle(string $message): void
    {
        var_dump('File log: test');
    }
}
