<?php

namespace Example\Tests\Repository;

use Example\App\Entity\Department;
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
        $repo->add(new Department('IT'));

        $this->expectNotToPerformAssertions();
    }

    /** @test */
    public function can_read_departments(): void
    {
        $repo = $this->getImplementation();
        $repo->add(new Department('Marketing'));

        $departments = $repo->all();

        $this->assertEquals($departments, [
            new Department('Marketing'),
        ]);
    }
}
