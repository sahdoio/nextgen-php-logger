<?php

namespace App\Helpers;

use DateTimeImmutable;
use Psr\Clock\ClockInterface;

class Clock implements ClockInterface
{
    public function __construct(private ?DateTimeImmutable $currentTime = null)
    {
        $this->currentTime = $currentTime ?? new DateTimeImmutable();
    }

    public function now(): DateTimeImmutable
    {
        return $this->currentTime;
    }
}
