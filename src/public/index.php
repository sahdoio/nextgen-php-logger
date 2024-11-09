<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;

require __DIR__ . '/../vendor/autoload.php';

$type = $argv[1];
$logStrategy = LoggerFactory::create($type);
$core = new LogProcessor($logStrategy);

var_dump($core);
