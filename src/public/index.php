<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;
use App\Enums\LogLevel;
use App\Enums\LogType;

require __DIR__ . '/../vendor/autoload.php';

if ($argc < 3) {
    echo "Usage: php index.php <message> <type>\n";
    exit(1);
}

$message = $argv[1];
$type = $argv[2];
$level = $argv[3];

if (empty($message)) {
    echo "Error: Message cannot be empty.\n";
    exit(1);
}

$validTypes = array_map(fn(LogType $type) => $type->value, LogType::cases());
if (!in_array($type, $validTypes)) {
    echo "Error: Invalid log type. Valid types are: " . implode(', ', $validTypes) . "\n";
    exit(1);
}

$validLevels = array_map(fn(LogLevel $level) => $level->value, LogLevel::cases());
if (!in_array($level, $validLevels)) {
    echo "Error: Invalid log level. Valid levels are: " . implode(', ', $validLevels) . "\n";
    exit(1);
}

$logStrategy = LoggerFactory::create(LogType::from($type));
$core = new LogProcessor($logStrategy);
$core->exec($message, LogLevel::from($level));
