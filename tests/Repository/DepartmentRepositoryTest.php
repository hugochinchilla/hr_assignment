<?php

namespace Example\Tests\Repository;

use Example\App\Entity\Department;
use Example\App\Repository\DepartmentRepository;
use PHPUnit\Framework\TestCase;

abstract class DepartmentRepositoryTest extends TestCase
{
    abstract protected function getImplementation(): DepartmentRepository;

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
        $this->markTestIncomplete("not implemented");
        $repo = $this->getImplementation();
        $repo->add(new Department('Marketing'));

        $departments = $repo->all();

        $this->assertEquals($departments, [
            new Department('Marketing'),
        ]);
    }
}
