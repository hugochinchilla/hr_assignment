<?php

declare(strict_types = 1);

namespace Example\App\UseCase\GetDepartmentsAlongHighestSalary;

interface GetDepartmentsAlongHighestSalaryInterface
{
    /**
     * @return DepartmentWithSalaryEntry[]
     */
    public function execute(): array;
}
