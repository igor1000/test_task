<?php

declare(strict_types=1);

namespace App\People\Application\UseCase;

use App\Common\Application\Factory\FakerFactory;
use App\People\Application\Dto\MaxAndMinYear;
use App\People\Application\Dto\Person;

final readonly class PeopleUseCase
{
    public function __construct(
        private FakerFactory $fakerFactory
    ) {
    }

    /**
     * Создание таблицы с данными о людях
     *
     * @param int $countPersons
     * @return Person[]
     */
    public function createTablePersons(int $countPersons): array
    {
        $faker = $this->fakerFactory->create();

        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[$i] = Person::create($i, $faker->year, $faker->year);
        }

        return $users;
    }

    public function getMinAndMaxYEars(array $persons): MaxAndMinYear
    {
        $minYear = 0;
        $maxYear = 0;

        for ($i = 1; $i <= 10; $i++) {
            $user = $persons[$i];

            $birthYear = $user->birthYear;
            $deathYear = $user->deathYear;

            if ($minYear > $birthYear) {
                $minYear = $birthYear;
            }

            if ($maxYear < $deathYear) {
                $maxYear = $deathYear;
            }
        }

        return new MaxAndMinYear($minYear, $maxYear);
    }

    public function getCountPeopleGroupByYear(array $persons, MaxAndMinYear $year): array
    {
        $yearsWithUsers = [];

        for ($i = $year->minYear; $i <= $year->maxYear; $i++) {
            foreach ($persons as $person) {
                if ($person->birthYear >= $i && $person->deathYear <= $i) {
                    if (isset($yearsWithUsers[$i])) {
                        $yearsWithUsers[$i]++;
                    } else {
                        $yearsWithUsers[$i] = 1;
                    }
                }
            }
        }

        return $yearsWithUsers;
    }
}