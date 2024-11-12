<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;
use App\Strategies\FileLogger;
use App\Strategies\DatabaseLogger;

test('Should call file log strategy successfully', function () {
    $type = 'file';
    $logStrategy = LoggerFactory::create($type);
    $sut = new LogProcessor($logStrategy);
    $sut->exec('message');
    $this->assertInstanceOf(FileLogger::class, $sut->getStrategy());
});

test('Should call database strategy successfully', function () {
    $type = 'database';
    $logStrategy = LoggerFactory::create($type);
    $sut = new LogProcessor($logStrategy);
    $sut->exec('message');
    $this->assertInstanceOf(DatabaseLogger::class, $sut->getStrategy());
});
