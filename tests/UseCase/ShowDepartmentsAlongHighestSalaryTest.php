<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase;

use Example\App\Entity\Department;
use Example\App\Entity\DepartmentId;
use Example\App\Entity\Employee;
use Example\App\UseCase\ShowDepartmentsAlongHighestSalary\DepartmentReportEntry;
use Example\App\UseCase\ShowDepartmentsAlongHighestSalary\ShowDepartmentsAlongHighestSalary;
use Example\Tests\Repository\InMemoryDepartmentRepository;
use PHPUnit\Framework\TestCase;

class ShowDepartmentsAlongHighestSalaryTest extends TestCase
{
    /** @test */
    public function a_department_without_employees_shows_zero_as_highest_salary(): void
    {
        $departmentRepo = new InMemoryDepartmentRepository();
        $departmentRepo->add(new Department(new DepartmentId(), 'Marketing'));
        $report = new ShowDepartmentsAlongHighestSalary($departmentRepo);

        $result = $report->execute();

        self::assertEquals($result, [
            new DepartmentReportEntry('Marketing', 0),
        ]);
    }

    /** @test */
    public function shows_highest_salary_across_employees_of_a_department(): void
    {
        $departmentRepo = new InMemoryDepartmentRepository();
        $departmentRepo->add(
            new Department(
                new DepartmentId(), 'IT', [
                                      new Employee('Hugo', 60000),
                                      new Employee('John', 70000),
                                  ]
            ),
        );
        $report = new ShowDepartmentsAlongHighestSalary($departmentRepo);

        $result = $report->execute();

        self::assertEquals($result, [
            new DepartmentReportEntry('IT', 70000),
        ]);
    }
}
