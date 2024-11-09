<?php

namespace App\Contracts;

interface LoggerStrategyContract
{
    public function handle(string $message): void;
}
