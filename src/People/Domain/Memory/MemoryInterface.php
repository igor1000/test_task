<?php

declare(strict_types=1);

namespace App\People\Domain\Memory;

interface MemoryInterface
{
    /**
     * @return array
     */
    public function getData(): array;
}
