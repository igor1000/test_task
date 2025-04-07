<?php

declare(strict_types=1);

namespace App\People\Domain;

final class YearsWithMaxLifePeople
{
    public array $yearsSortedByLifetime;
    public array $fiveBetterYears;

    public function __construct(array $years, array $fiveBetterYears)
    {
        $this->yearsSortedByLifetime = $years;
        $this->fiveBetterYears = $fiveBetterYears;
    }
}
