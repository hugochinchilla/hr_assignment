<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ListDepartments;

use Example\App\UseCase\DTO;

class DepartmentDTO implements DTO
{
    public function __construct(private string $id, private string $name, private array $employees)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function employees(): array
    {
        return $this->employees;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'employees' => array_map(fn (EmployeeDTO $e) => $e->toArray(), $this->employees),
        ];
    }
}
