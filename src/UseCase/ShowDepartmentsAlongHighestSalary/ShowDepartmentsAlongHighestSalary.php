<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ShowDepartmentsAlongHighestSalary;

use Example\App\Entity\Department;

class ShowDepartmentsAlongHighestSalary
{
    /**
     * @param Department[] $departments
     */
    public function __construct(private array $departments)
    {
    }

    public function execute(): array
    {
        return iterator_to_array($this->generateReportEntries());
    }

    private function generateReportEntries(): \Generator
    {
        foreach ($this->departments as $department) {
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
