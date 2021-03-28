<?php

namespace Example\Tests\UseCase\ShowDepartmentsWithHighExpenses;

use Example\App\Entity\Department;
use Example\App\Entity\DepartmentId;
use Example\App\Entity\Employee;
use Example\App\UseCase\ShowDepartmentsWithHighExpenses\ShowDepartmentsWithHighExpenses;
use Example\Tests\Repository\InMemoryDepartmentRepository;
use PHPUnit\Framework\TestCase;

class ShowDepartmentsWithHighExpensesTest extends TestCase
{
    /** @test */
    public function ignores_departments_with_exactly_two_or_less_employees_with_a_pay_over_50k(): void
    {
        $departmentRepo = new InMemoryDepartmentRepository();
        $departmentRepo->add(new Department(new DepartmentId(), 'IT', [
            new Employee('Mary', 50001),
            new Employee('Jane', 50001),
        ]));
        $report = new ShowDepartmentsWithHighExpenses($departmentRepo);

        $result = $report->execute();

        $this->assertEquals($result, []);
    }

    /** @test */
    public function shows_departments_with_more_than_two_employees_with_a_pay_over_50k(): void
    {
        $departmentRepo = new InMemoryDepartmentRepository();
        $departmentRepo->add(new Department(new DepartmentId(), 'IT', [
            new Employee('John', 50000),
            new Employee('Bruce', 50001),
            new Employee('Mary', 60000),
            new Employee('Jane', 60000),
        ]));
        $report = new ShowDepartmentsWithHighExpenses($departmentRepo);

        $result = $report->execute();

        $this->assertEquals($result, ['IT']);
    }
}
