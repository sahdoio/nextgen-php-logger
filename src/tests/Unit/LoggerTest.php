<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;
use App\Strategies\FileLogger;
use App\Strategies\InMemoryLogger;
use App\Enums\LogLevel;
use App\Enums\LogType;

test('Should call file log strategy successfully', function () {
    $logStrategy = LoggerFactory::create(Logtype::FILE);
    $sut = new LogProcessor($logStrategy);
    $sut->exec("Hi, I'm a file test", LogLevel::INFO);
    $this->assertInstanceOf(FileLogger::class, $sut->getStrategy());
});

test('Should call in_memory strategy successfully', function () {
    $logStrategy = LoggerFactory::create(LogType::IN_MEMORY);
    $sut = new LogProcessor($logStrategy);
    $sut->exec("Hi, I'm a in_memory test" , LogLevel::INFO);
    $this->assertInstanceOf(InMemoryLogger::class, $sut->getStrategy());
});
