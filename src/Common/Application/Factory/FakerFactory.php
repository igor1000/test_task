<?php

declare(strict_types=1);

namespace App\Common\Application\Factory;

use Faker\Factory;
use Faker\Generator;

class FakerFactory
{
    public function create(): Generator
    {
        return Factory::create();
    }
}
