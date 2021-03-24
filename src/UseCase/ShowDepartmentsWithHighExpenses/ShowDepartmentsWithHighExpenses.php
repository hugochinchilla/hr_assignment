<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ShowDepartmentsWithHighExpenses;

use Example\App\Repository\DepartmentRepository;

class ShowDepartmentsWithHighExpenses
{
    const HIGH_SALARY_THRESHOLD = 50000;

    public function __construct(private DepartmentRepository $departmentRepository)
    {
    }

    /**
     * @return array<string>
     */
    public function execute(): array
    {
        return iterator_to_array($this->generateReportEntries());
    }

    private function generateReportEntries(): \Generator
    {
        foreach ($this->departmentRepository->all() as $department) {
            $employeesWithHighSalaryCount = 0;
            foreach ($department->employees() as $employee) {
                if ($employee->salary() > self::HIGH_SALARY_THRESHOLD) {
                    ++$employeesWithHighSalaryCount;
                }
            }

            if ($employeesWithHighSalaryCount > 2) {
                yield $department->name();
            }
        }
    }
}
