<?php

declare(strict_types = 1);

namespace Example\App\UseCase\CreateDepartment;

class CreateDepartmentCommand
{
    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }
}
