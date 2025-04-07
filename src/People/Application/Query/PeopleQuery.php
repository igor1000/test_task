<?php

declare(strict_types=1);

namespace App\People\Application\Query;

use App\People\Application\Dto\Person;
use App\People\Domain\Memory\MemoryInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class PeopleQuery
{
    private MemoryInterface $memoryInterface;
    private DenormalizerInterface $serializer;

    public function __construct(
        MemoryInterface $memoryInterface,
        DenormalizerInterface $serializer
    ) {
        $this->memoryInterface = $memoryInterface;
        $this->serializer = $serializer;
    }

    /**
     * @return list<Person>
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getAll(): array
    {
        $people = [];

        foreach ($this->memoryInterface->getData() as $person) {
            $people[] = $this->serializer->denormalize($person, Person::class);
        }

        return $people;
    }
}
