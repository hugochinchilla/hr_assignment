<?php

declare(strict_types = 1);

namespace Example\App\UseCase;

interface DTO
{
    public function toArray(): array;
}
