<?php

namespace App\Strategies;

use App\Contracts\LoggerStrategyContract;
use App\Enums\LogLevel;

class FileLogger implements LoggerStrategyContract
{
    private string $logFile;

    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../logs/app.log';
    }

    public function handle(string $message, LogLevel $level): void
    {
        var_dump("[File] {$level->value}: $message\n");
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[$timestamp][{$level->value}] $message";
        $fileHandle = fopen($this->logFile, 'a');
        if ($fileHandle) {
            fwrite($fileHandle, $formattedMessage . PHP_EOL);
            fclose($fileHandle);
            return;
        }
        // Handle error if file cannot be opened
        throw new \RuntimeException('Unable to open log file for writing.');
    }
}
