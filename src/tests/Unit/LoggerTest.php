<?php

namespace Tests\Unit;

use App\Enums\LogLevel;
use App\Enums\LogType;
use App\Factories\LoggerFactory;
use App\LogProcessor;
use App\Strategies\FileLogger;
use App\Strategies\InMemoryLogger;
use Exception;

beforeEach(function () {
    $this->logFile = ROOT_DIR . '/logs/test.log';
});

describe('LoggerFactory', function () {
    it('should call file log strategy successfully', function () {
        $logStrategy = LoggerFactory::create(type: Logtype::FILE, resource: $this->logFile);
        $sut = new LogProcessor($logStrategy);
        $sut->exec("Hi, I'm a file test", LogLevel::INFO);
        $this->assertInstanceOf(FileLogger::class, $sut->getStrategy());
    });

    it('should call in_memory strategy successfully', function () {
        $logStrategy = LoggerFactory::create(type: LogType::IN_MEMORY);
        $sut = new LogProcessor($logStrategy);
        $sut->exec("Hi, I'm a in_memory test", LogLevel::INFO);
        $this->assertInstanceOf(InMemoryLogger::class, $sut->getStrategy());
    });

    it('should fail with an Exception', function () {
        $fileLoggerMock = $this->createMock(FileLogger::class);
        $fileLoggerMock->expects($this->once())
            ->method('handle')
            ->willThrowException(new Exception('Unknown exception'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown exception');

        $sut = new LogProcessor($fileLoggerMock);
        $sut->exec("Hi, I'm a in_memory test", LogLevel::INFO);
    });
});
