<?php

namespace App;

use App\Contracts\LoggerStrategyContract;
use App\Contracts\LogProcessorContract;
use App\Enums\LogLevel;
use Exception;

readonly class LogProcessor implements LogProcessorContract
{
    public function __construct(private LoggerStrategyContract $logStrategy) {
    }

    public function getStrategy(): LoggerStrategyContract {
        return $this->logStrategy;
    }

    /**
     * @param string $message
     * @param LogLevel $level
     * @return void
     * @throws Exception
     */
    public function exec(string $message, LogLevel $level): void
    {
        try {
            $this->logStrategy->handle($message, $level);
        } catch (\Exception $e) {
            echo "App error: " . $e->getMessage();
            throw $e;
        }
    }
}
