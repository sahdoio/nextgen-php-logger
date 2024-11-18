<?php

namespace App\Helpers;

use App\Contracts\FileHandlerContract;
use RuntimeException;

class FileHandler implements FileHandlerContract
{
    private mixed $fileStream;

    public function open(string $filePath, string $mode): void
    {
        $this->fileStream = fopen($filePath, $mode);

        if (!$this->fileStream) {
            throw new RuntimeException('Unable to open log file for writing.');
        }
    }

    public function write(string $data): void
    {
        fwrite($this->fileStream, $data);
    }

    public function close(): void
    {
        fclose($this->fileStream);
    }
}
