<?php

declare(strict_types = 1);

namespace Example\Tests\Entity;

use Example\App\Entity\Department;
use Example\App\Entity\DepartmentId;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    /** @test */
    public function a_department_has_an_id(): void
    {
        $anyDepartmentId = new DepartmentId();

        $department = new Department($anyDepartmentId, "IT");

        $this->assertTrue($anyDepartmentId->equals($department->id()));
    }

    /** @test */
    public function a_department_has_a_name(): void
    {
        $department = new Department(new DepartmentId(), "IT");

        $this->assertEquals('IT', $department->name());
    }
}
