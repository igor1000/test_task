<?php

declare(strict_types=1);

namespace App\Common\Domain;

use Faker\Generator;

interface FakerInterface
{
    public function create(): Generator;
}