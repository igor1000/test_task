<?php

declare(strict_types=1);

namespace App\People\Http\Controller;

use App\People\Application\UseCase\PeopleUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeopleController extends AbstractController
{
    public function __construct(
        private PeopleUseCase $peopleUseCase
    ) {
    }

    #[Route('/get-years-with-max-live-people')]
    public function getYearsWithMaxLivePeople(): Response
    {
        $persons = $this->peopleUseCase->createTablePersons(20);

        $yearsWithUsers = $this->peopleUseCase->getCountPeopleGroupByYear(
            $persons,
            $this->peopleUseCase->getMinAndMaxYEars($persons)
        );

        uasort($yearsWithUsers, fn($firstYear, $secondYear) => $secondYear <=> $firstYear);

        $yearsWithUsers = array_slice(array_flip($yearsWithUsers), 0, 5);

        return $this->json($yearsWithUsers);
    }
}