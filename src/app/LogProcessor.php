<?php

namespace App;

use App\Contracts\LogProcessorContract;
use App\Contracts\LoggerStrategyContract;

class LogProcessor implements LogProcessorContract
{
    public function __construct(private LoggerStrategyContract $logStrategy) {
    }

    public function setStrategy(LoggerStrategyContract $strategy): void {
        $this->logStrategy = $strategy;
    }

    public function exec(string $message): void
    {
        $this->logStrategy->handle($message);
    }
}
