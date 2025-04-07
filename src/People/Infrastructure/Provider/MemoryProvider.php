<?php

declare(strict_types=1);

namespace App\People\Infrastructure\Provider;

use App\People\Domain\Memory\MemoryInterface;
use App\People\Domain\Person;
use Faker\Factory;

final class MemoryProvider implements MemoryInterface
{
    private array $users = [];

    public function __construct()
    {
        $this->fillData();
    }

    /**
     * Создание таблицы с данными о людях
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->users;
    }

    private function fillData(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < $faker->randomNumber(); $i++) {
            $this->users[$i] = ['id' => $i, 'birthYear' =>  (int)$faker->year, 'deathYear' =>  (int)$faker->year];
        }
    }
}
