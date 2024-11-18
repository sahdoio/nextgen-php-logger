<?php

namespace Tests\Unit;

use App\Contracts\FileHandlerContract;
use App\Enums\LogLevel;
use App\Enums\LogType;
use App\Factories\LoggerFactory;
use App\Helpers\Clock;
use App\Helpers\FileHandler;
use App\LogProcessor;
use App\Strategies\FileLogger;
use DateTimeImmutable;
use Psr\Clock\ClockInterface;
use RuntimeException;

beforeEach(function () {
    $this->myLogDT = new DateTimeImmutable('2021-08-01 00:00:00');

    $this->clockStub = $this->createStub(ClockInterface::class);
    $this->clockStub->method('now')->willReturn($this->myLogDT);

    $fileHandler = $this->createStub(FileHandlerContract::class);

    $this->logFile = ROOT_DIR . '/logs/test.log';

    file_put_contents($this->logFile, '');

    $this->logStrategy = LoggerFactory::create(
        type: LogType::FILE,
        clock: $this->clockStub,
        fileHandler: $fileHandler,
        resource: $this->logFile
    );

    $this->sut = new LogProcessor($this->logStrategy);
});

describe('FileLogger', function () {
    it('Should fail with RuntimeException when log file cannot be opened', function () {
        $logFilePath = '/tmp/invalidfile.txt';

        $clock = $this->createStub(Clock::class);
        $clock->method('now')->willReturn(new DateTimeImmutable());

        $fileHandler = $this->createMock(FileHandler::class);
        $fileHandler->method('open')->willThrowException(new RuntimeException('Unable to open log file for writing.'));

        $fileLogger = new FileLogger($logFilePath, $clock, $fileHandler);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to open log file for writing.');

        $fileLogger->handle("This should fail", LogLevel::ERROR);
    });
});


