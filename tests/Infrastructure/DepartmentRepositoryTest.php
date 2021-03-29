<?php

declare(strict_types = 1);

namespace Example\Tests\Infrastructure;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\Entity\Employee;
use Example\App\Domain\ValueObject\DepartmentId;
use PHPUnit\Framework\TestCase;

abstract class DepartmentRepositoryTest extends TestCase
{
    private DepartmentRepository $implementation;

    abstract protected function getImplementation(): DepartmentRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->implementation = $this->getImplementation();
        $this->implementation->deleteAll();
    }

    /** @test */
    public function can_insert_departments(): void
    {
        $repo = $this->getImplementation();
        $repo->add(new Department(new DepartmentId(), 'IT'));

        $this->expectNotToPerformAssertions();
    }

    /** @test */
    public function can_read_departments(): void
    {
        $anyDepartment = new Department(new DepartmentId(), 'Marketing');
        $this->implementation->add($anyDepartment);

        $departments = $this->implementation->all();

        $this->assertCount(1, $departments);
        $readDepartment = $departments[0];
        $this->assertEquals($anyDepartment->name(), $readDepartment->name());
        $this->assertTrue($readDepartment->id()->equals($anyDepartment->id()));
    }

    /** @test */
    public function can_read_department_employees(): void
    {
        $anyDepartment = new Department(new DepartmentId(), 'Marketing', [
            new Employee('Martin', 60000),
        ]);
        $this->implementation->add($anyDepartment);

        $departments = $this->implementation->all();

        $readDepartment = $departments[0];
        $this->assertCount(1, $readDepartment->employees());
        $firstEmployee = $readDepartment->employees()[0];
        $this->assertEquals('Martin', $firstEmployee->name());
        $this->assertEquals(60000, $firstEmployee->salary());
    }

    /** @test */
    public function can_update_department_employees(): void
    {
        $anyDepartment = new Department(new DepartmentId(), 'Marketing', [
            new Employee('Martin', 60000),
        ]);
        $this->implementation->add($anyDepartment);
        $anyDepartment->addEmployee(new Employee('Mike', 30000));

        $this->implementation->update($anyDepartment);

        $departments = $this->implementation->all();
        $readDepartment = $departments[0];
        $this->assertCount(2, $readDepartment->employees());
    }
}
