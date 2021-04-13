<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\GetDepartmentsAlongHighestSalary;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\Entity\Employee;
use Example\App\Domain\ValueObject\DepartmentId;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\DepartmentWithSalaryDTO;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\GetDepartmentsAlongHighestSalaryInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractGetDepartmentsAlongHighestSalaryTest extends TestCase
{
    private GetDepartmentsAlongHighestSalaryInterface $query;
    private DepartmentRepository $repository;

    abstract public function getImplementation(): GetDepartmentsAlongHighestSalaryInterface;

    abstract public function getRepository(): DepartmentRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->getRepository();
        $this->query = $this->getImplementation();
        $this->repository->deleteAll();
    }

    /** @test */
    public function a_department_without_employees_shows_zero_as_highest_salary(): void
    {
        $this->repository->add(new Department(new DepartmentId(), 'Marketing'));

        $result = $this->query->execute();

        self::assertEquals($result, [
            new DepartmentWithSalaryDTO('Marketing', 0),
        ]);
    }

    /** @test */
    public function shows_highest_salary_across_employees_of_a_department(): void
    {
        $this->repository->add(
            new Department(
                new DepartmentId(), 'IT', [
                    new Employee('Hugo', 60000),
                    new Employee('John', 70000),
                ]
            ),
        );

        $result = $this->query->execute();

        self::assertEquals($result, [
            new DepartmentWithSalaryDTO('IT', 70000),
        ]);
    }
}
