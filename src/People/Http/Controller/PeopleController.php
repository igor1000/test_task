<?php

declare(strict_types=1);

namespace App\People\Http\Controller;

use App\People\Application\UseCase\GetYearsWithMaxLivePeople;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PeopleController extends AbstractController
{
    private GetYearsWithMaxLivePeople $getYearsWithMaxLivePeople;

    public function __construct(
        GetYearsWithMaxLivePeople $getYearsWithMaxLivePeople
    ) {
        $this->getYearsWithMaxLivePeople = $getYearsWithMaxLivePeople;
    }

    /**
     * @Route("/get-years-with-max-live-people")
     * @return Response
     */
    public function getYearsWithMaxLivePeople(): Response
    {
        return $this->json($this->getYearsWithMaxLivePeople->handle());
    }
}
