<?php

declare(strict_types=1);

namespace App\People\Application\Dto;

final readonly class MaxAndMinYear
{
    public function __construct(
        public int $minYear,
        public int $maxYear
    ) {
    }
}