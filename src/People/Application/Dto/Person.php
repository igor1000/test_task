<?php

declare(strict_types=1);

namespace App\People\Application\Dto;
final class Person
{
    public int $id;
    public int $birthYear;
    public int $deathYear;

    public function __construct(int $id, int $birthYear, int $deathYear)
    {
        $this->id = $id;
        $this->birthYear = $birthYear;
        $this->deathYear = $deathYear;
    }
}
