<?php

declare(strict_types=1);

namespace App\People\Application\UseCase;

use App\People\Application\Dto\Person;
use App\People\Application\Query\PeopleQuery;
use App\People\Domain\YearsWithMaxLifePeople;

final class GetYearsWithMaxLivePeople
{
    const COUNT_TOP_YEARS = 5;

    private PeopleQuery $peopleQuery;

    public function __construct(
        PeopleQuery $peopleQuery
    ) {
        $this->peopleQuery = $peopleQuery;
    }

    public function handle(): ?YearsWithMaxLifePeople
    {
        $persons = $this->peopleQuery->getAll();

        if (!$persons) {
            return null;
        }

        [$minLifeYear, $maxLifeYear] = $this->getMinAndMaxLifeYears($persons);

        $yearsWithLifePeople = $this->getCountLifePeopleGroupByYear($persons, $minLifeYear, $maxLifeYear);

        uasort($yearsWithLifePeople, fn($firstYear, $secondYear) => $secondYear <=> $firstYear);

        $yearsWithMaxLivePeople = array_keys($yearsWithLifePeople);

        return new YearsWithMaxLifePeople(
            $yearsWithMaxLivePeople,
            array_slice($yearsWithMaxLivePeople, 0, self::COUNT_TOP_YEARS),
        );
    }

    /** вынес функции из сервиса, т.к. вижу, что в нем пока нет необходимости */

    /**
     * Получение количество живых людей сгруппированных по годам
     *
     * @param list<Person> $persons
     * @param int $minLifeYear
     * @param int $maxLifeYear
     * @return array
     */
    private function getCountLifePeopleGroupByYear(array $persons, int $minLifeYear, int $maxLifeYear): array
    {
        $yearsWithUsers = [];

        for ($year = $minLifeYear; $year <= $maxLifeYear; $year++) {
            foreach ($persons as $person) {
                if ($person->birthYear >= $year && $person->deathYear <= $year) {
                    if (isset($yearsWithUsers[$year])) {
                        $yearsWithUsers[$year]++;
                    } else {
                        $yearsWithUsers[$year] = 1;
                    }
                }
            }
        }

        return $yearsWithUsers;
    }

    /**
     * Получение максимального и минимального годов жизни
     *
     * @param list<Person> $persons
     * @return array
     */
    private function getMinAndMaxLifeYears(array $persons): array
    {
        $minYear = $persons[0]->birthYear;
        $maxYear = $persons[0]->deathYear;

        foreach ($persons as $person) {
            $birthYear = $person->birthYear;
            $deathYear = $person->deathYear;

            if ($minYear > $birthYear) {
                $minYear = $birthYear;
            }

            if ($maxYear < $deathYear) {
                $maxYear = $deathYear;
            }
        }

        return [$minYear, $maxYear];
    }
}
