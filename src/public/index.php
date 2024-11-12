<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;
use App\Enums\LogLevel;

require __DIR__ . '/../vendor/autoload.php';

// Validate arguments
if ($argc < 3) {
    echo "Usage: php index.php <message> <type>\n";
    exit(1);
}

$message = $argv[1];
$type = $argv[2];
$level = $argv[3];

// Validate message
if (empty($message)) {
    echo "Error: Message cannot be empty.\n";
    exit(1);
}

// Validate type
$validTypes = ['file', 'database', 'console']; // Add valid types as needed
if (!in_array($type, $validTypes)) {
    echo "Error: Invalid log type. Valid types are: " . implode(', ', $validTypes) . "\n";
    exit(1);
}

// Validate level
$validLevels = array_map(fn(LogLevel $level) => $level->value, LogLevel::cases()); // Add valid types as needed
if (!in_array($level, $validLevels)) {
    echo "Error: Invalid log level. Valid levels are: " . implode(', ', $validLevels) . "\n";
    exit(1);
}

$logStrategy = LoggerFactory::create($type);
$core = new LogProcessor($logStrategy);
$core->exec($message, LogLevel::from($level));
