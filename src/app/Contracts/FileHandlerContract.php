<?php

namespace App\Contracts;

interface FileHandlerContract
{
    function open(string $filePath, string $mode): void;
    function write(string $data): void;
    function close(): void;
}
