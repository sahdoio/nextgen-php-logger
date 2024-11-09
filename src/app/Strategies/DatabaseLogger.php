<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyContract;

class DatabaseLogger implements LoggerStrategyContract
{
    public function handle(string $message): void
    {
        var_dump('Database log: test');
    }
}
