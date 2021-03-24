<?php

declare(strict_types = 1);

namespace Example\App\Entity;

class Department
{
    public function __construct(private string $name, private array $employees = [])
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Employee[]
     */
    public function employees(): array
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }
}
