<?php

namespace Tests\Unit;

use App\Enums\LogLevel;
use App\Strategies\InMemoryLogger;
use DateTimeImmutable;
use Psr\Clock\ClockInterface;

beforeEach(function () {
    $this->myLogDT = new DateTimeImmutable('2021-08-01 00:00:00');
    $this->clockStub = $this->createStub(ClockInterface::class);
    $this->clockStub->method('now')->willReturn($this->myLogDT);
});

describe('InMemoryLogger', function () {
    it('should log messages successfully', function () {
        $logger = new InMemoryLogger($this->clockStub);
        $logger->handle('Hello, world!', LogLevel::INFO);

        expect($logger->getLogs())->toBe([
            "[{$this->clockStub->now()->format('Y-m-d H:i:s')}][info] Hello, world!",
        ]);
    });

    it('should check whether the last message is correct or not', function () {
        $logger = new InMemoryLogger($this->clockStub);
        $logger->handle('Message 1', LogLevel::INFO);
        $logger->handle('Message 2', LogLevel::INFO);

        expect($logger->getLastLog())->toBe("[{$this->clockStub->now()->format('Y-m-d H:i:s')}][info] Message 2");
    });
});
