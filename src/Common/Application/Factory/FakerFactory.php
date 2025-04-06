<?php

declare(strict_types=1);

namespace App\Common\Application\Factory;

use App\Common\Domain\FakerInterface;
use Faker\Factory;
use Faker\Generator;

class FakerFactory implements FakerInterface
{
    public function create(): Generator
    {
        return Factory::create();
    }
}
