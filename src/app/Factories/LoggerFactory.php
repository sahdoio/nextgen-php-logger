<?php

namespace App\Factories;

use App\Contracts\FileHandlerContract;
use App\Contracts\LoggerStrategyContract;
use App\Enums\LogType;
use App\Helpers\Clock;
use App\Helpers\FileHandler;
use App\Strategies\InMemoryLogger;
use App\Strategies\FileLogger;
use Psr\Clock\ClockInterface;

class LoggerFactory
{
    public static function create(
        LogType $type,
        ?ClockInterface $clock = null,
        ?FileHandlerContract $fileHandler = null,
        ?string $resource = null,
    ): LoggerStrategyContract
    {
        $myClock = $clock ?? new Clock();
        $myFileHandler = $fileHandler ?? new FileHandler();

        return match ($type) {
            LogType::FILE => new FileLogger($resource, $myClock, $myFileHandler),
            LogType::IN_MEMORY => new InMemoryLogger($myClock)
        };
    }
}
