<?php

declare(strict_types = 1);

namespace Example\App\UseCase\HireEmployee;

use Example\App\Domain\ValueObject\DepartmentId;

class HireEmployeeCommand
{
    public function __construct(private DepartmentId $departmentId, private string $name, private int $salary)
    {
    }

    public function departmentId(): DepartmentId
    {
        return $this->departmentId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function salary(): int
    {
        return $this->salary;
    }
}
