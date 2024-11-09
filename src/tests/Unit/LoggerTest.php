<?php

use App\LogProcessor;
use App\Factories\LoggerFactory;

test('Should call log strategy successfully', function () {
    $type = 'file';
    $logStrategy = LoggerFactory::create($type);
    $sut = new LogProcessor($logStrategy);

    $sut->exec('message');

    expect(true)->toBeTrue();
});

test('Should call database strategy successfully', function () {
    $type = 'database';
    $logStrategy = LoggerFactory::create($type);
    $sut = new LogProcessor($logStrategy);

    $sut->exec('message');

    expect(true)->toBeTrue();
});
