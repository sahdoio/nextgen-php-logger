<?php

namespace App;

use App\Contracts\LogProcessorContract;
use App\Contracts\LoggerStrategyContract;
use App\Enums\LogLevel;

class LogProcessor implements LogProcessorContract
{
    public function __construct(private LoggerStrategyContract $logStrategy) {
    }

    public function setStrategy(LoggerStrategyContract $strategy): void {
        $this->logStrategy = $strategy;
    }

    public function getStrategy(): LoggerStrategyContract {
        return $this->logStrategy;
    }

    public function exec(string $message, LogLevel $level): void
    {
        try {
            $this->logStrategy->handle($message, $level);
        } catch (\Exception $e) {
            echo "App error: " . $e->getMessage();
        }
    }
}
