<?php

namespace App\Factories;

use App\Contracts\LoggerStrategyContract;
use App\Strategies\DatabaseLogger;
use App\Strategies\FileLogger;
use InvalidArgumentException;

class LoggerFactory
{
    public static function create(string $type): LoggerStrategyContract
    {
        return match ($type) {
            'file' => new FileLogger(),
            'database' => new DatabaseLogger(),
            default => throw new InvalidArgumentException('Invalid logger type'),
        };
    }
}
