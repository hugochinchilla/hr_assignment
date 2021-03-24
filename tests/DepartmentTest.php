<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Entity\Department;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    /** @test */
    public function a_department_has_a_name(): void
    {
        $department = new Department("IT");

        $this->assertEquals('IT', $department->name());
    }
}
