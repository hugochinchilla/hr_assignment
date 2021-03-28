<?php

declare(strict_types = 1);

namespace Example\App\Entity;

class Department
{
    public function __construct(private DepartmentId $id, private string $name, private array $employees = [])
    {
    }

    public function id(): DepartmentId
    {
        return $this->id;
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
