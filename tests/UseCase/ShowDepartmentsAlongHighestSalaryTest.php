<?php

namespace Example\Tests\UseCase;

use Example\App\Entity\Department;
use Example\App\Entity\Employee;
use Example\App\UseCase\ShowDepartmentsAlongHighestSalary\DepartmentReportEntry;
use Example\App\UseCase\ShowDepartmentsAlongHighestSalary\ShowDepartmentsAlongHighestSalary;
use PHPUnit\Framework\TestCase;

class ShowDepartmentsAlongHighestSalaryTest extends TestCase
{
    /** @test */
    public function a_department_without_employees_shows_zero_as_highest_salary(): void
    {
        $departments = [
            new Department('Marketing'),
        ];
        $report = new ShowDepartmentsAlongHighestSalary($departments);
        $result = $report->execute();

        self::assertEquals($result, [
            new DepartmentReportEntry("Marketing", 0),
        ]);
    }

    /** @test */
    public function shows_highest_salary_across_employees_of_a_department(): void
    {
        $departments = [
            new Department('IT', [new Employee('Hugo', 60000), new Employee('John', 70000)]),
        ];
        $report = new ShowDepartmentsAlongHighestSalary($departments);
        $result = $report->execute();

        self::assertEquals($result, [
            new DepartmentReportEntry("IT", 70000),
        ]);
    }
}
