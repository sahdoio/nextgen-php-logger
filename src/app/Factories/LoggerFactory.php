<?php

namespace App\Factories;

use App\Contracts\LoggerStrategyContract;
use App\Enums\LogType;
use App\Strategies\InMemoryLogger;
use App\Strategies\FileLogger;

class LoggerFactory
{
    public static function create(LogType $type): LoggerStrategyContract
    {
        return match ($type) {
            LogType::FILE => new FileLogger(),
            LogType::IN_MEMORY => new InMemoryLogger()
        };
    }
}
