<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ListDepartments;

use Example\App\UseCase\DTO;

class EmployeeDTO implements DTO
{
    public function __construct(private string $name, private int $salary)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function salary(): int
    {
        return $this->salary;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'salary' => $this->salary,
        ];
    }
}
