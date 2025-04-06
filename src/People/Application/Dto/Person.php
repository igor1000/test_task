<?php

declare(strict_types=1);

namespace App\People\Application\Dto;
final readonly class Person
{
    private function __construct(
        public int $id,
        public int $birthYear,
        public int $deathYear
    )
    {
    }

    public static function create(int $id, string $birthYear, string $deathYear): self
    {
        return new self($id, (int)$birthYear, (int)$deathYear);
    }
}
