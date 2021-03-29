<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\ListDepartments;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\Employee;
use Example\App\Domain\ValueObject\DepartmentId;
use Example\App\UseCase\ListDepartments\ListDepartments;
use Example\Tests\Infrastructure\InMemoryDepartmentRepository;
use PHPUnit\Framework\TestCase;

class ListDepartmentsTest extends TestCase
{
    /** @test */
    public function can_list_departments(): void
    {
        $anyDepartmentId = 'd5f5725f-cf7a-46f9-83f5-11a8bcff64bb';
        $repository = new InMemoryDepartmentRepository();
        $department = new Department(DepartmentId::fromString($anyDepartmentId), 'Example', [
            new Employee('Employee 1', 50000),
            new Employee('Employee 2', 43000),
        ]);
        $repository->add($department);
        $listDepartments = new ListDepartments($repository);

        $result = $listDepartments->execute();

        $this->assertEquals([
            [
                'id' => $anyDepartmentId,
                'name' => 'Example',
                'employees' => [
                    ['name' => 'Employee 1', 'salary' => 50000],
                    ['name' => 'Employee 2', 'salary' => 43000],
                ],
            ],
        ], $result->toArray());
    }
}
