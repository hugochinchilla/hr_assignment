<?php

declare(strict_types = 1);

namespace Example\Tests\Repository;

use Example\App\Entity\Department;
use Example\App\Repository\DepartmentRepository;

class InMemoryDepartmentRepository implements DepartmentRepository
{
    /** @var Department[] */
    private $departments = [];

    public function all(): array
    {
        return $this->departments;
    }

    public function add(Department $department): void
    {
        $this->departments[] = $department;
    }
}
