<?php

declare(strict_types=1);

namespace App\People\Application\UseCase;

use App\People\Application\Service\PeopleService;

final readonly class GetYearsWithMaxLivePeople
{
    public function __construct(
        private PeopleService $peopleService
    ) {
    }

    public function handle(int $countPeople): array
    {
        $persons = $this->peopleService->createTablePersons($countPeople);

        $yearsWithUsers = $this->peopleService->getCountPeopleGroupByYear(
            $persons,
            $this->peopleService->getMinAndMaxYEars($persons)
        );

        uasort($yearsWithUsers, fn($firstYear, $secondYear) => $secondYear <=> $firstYear);

        return array_slice(array_flip($yearsWithUsers), 0, 5);
    }
}
