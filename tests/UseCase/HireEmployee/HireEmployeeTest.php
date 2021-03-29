<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\HireEmployee;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\ValueObject\DepartmentId;
use Example\App\UseCase\HireEmployee\HireEmployee;
use Example\Tests\Infrastructure\InMemoryDepartmentRepository;
use PHPUnit\Framework\TestCase;

class HireEmployeeTest extends TestCase
{
    /** @test */
    public function an_employee_can_be_created(): void
    {
        $department = new Department(new DepartmentId(), 'IT');
        $departmentRepository = new InMemoryDepartmentRepository();
        $departmentRepository->add($department);
        $hireEmployee = new HireEmployee($departmentRepository);
        $command = new HireEmployeeCommand($department->id(), 'Linus', 100000);

        $hireEmployee->execute($command);

        $readDepartment = $departmentRepository->getById($department->id());
        $this->assertCount(1, $readDepartment->employees());
    }
}
