<?php

declare(strict_types = 1);

namespace Example\App\UseCase;

class CollectionDTO implements DTO
{
    public function __construct(
        // @var DTO[]
        private array $values
    ) {
    }

    public function values(): array
    {
        return $this->values;
    }

    public function toArray(): array
    {
        return array_map(fn (DTO $dto): array => $dto->toArray(), $this->values);
    }
}
