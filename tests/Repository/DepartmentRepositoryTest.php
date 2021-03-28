<?php

declare(strict_types = 1);

namespace Example\Tests\Repository;

use Example\App\Entity\Department;
use Example\App\Entity\DepartmentId;
use Example\App\Repository\DepartmentRepository;
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
        $repo = $this->getImplementation();
        $repo->add($anyDepartment);

        $departments = $repo->all();

        $this->assertCount(1, $departments);
        $readDepartment = $departments[0];
        $this->assertEquals($anyDepartment->name(), $readDepartment->name());
        $this->assertTrue($readDepartment->id()->equals($anyDepartment->id()));
    }
}
