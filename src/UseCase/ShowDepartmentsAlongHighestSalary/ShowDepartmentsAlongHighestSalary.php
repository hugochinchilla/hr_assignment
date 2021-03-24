<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ShowDepartmentsAlongHighestSalary;

use Example\App\Repository\DepartmentRepository;

class ShowDepartmentsAlongHighestSalary
{
    public function __construct(private DepartmentRepository $departmentRepository)
    {
    }

    public function execute(): array
    {
        return iterator_to_array($this->generateReportEntries());
    }

    private function generateReportEntries(): \Generator
    {
        foreach ($this->departmentRepository->all() as $department) {
            $highestSalary = 0;
            foreach ($department->employees() as $employee) {
                if ($employee->salary() > $highestSalary) {
                    $highestSalary = $employee->salary();
                }
            }

            yield new DepartmentReportEntry($department->name(), $highestSalary);
        }
    }
}
