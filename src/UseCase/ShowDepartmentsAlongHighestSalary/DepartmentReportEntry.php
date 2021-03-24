<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ShowDepartmentsAlongHighestSalary;

class DepartmentReportEntry
{
    public function __construct(private string $name, private int $highestSalary)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function highestSalary(): int
    {
        return $this->highestSalary;
    }
}
