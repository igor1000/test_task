<?php

declare(strict_types=1);

namespace App\People\Http\Controller;

use App\People\Application\UseCase\GetYearsWithMaxLivePeople;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PeopleController extends AbstractController
{
    public function __construct(
        private readonly GetYearsWithMaxLivePeople $getYearsWithMaxLivePeople
    ) {
    }

    #[Route(path: '/get-years-with-max-live-people/{countPeople<\d+>}', defaults: ['countPeople' => 10])]
    public function getYearsWithMaxLivePeople(Request $request): Response
    {
        return $this->json($this->getYearsWithMaxLivePeople->handle((int)$request->get('countPeople')));
    }
}
