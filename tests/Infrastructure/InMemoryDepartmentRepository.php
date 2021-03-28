<?php

declare(strict_types = 1);

namespace Example\Tests\Infrastructure;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;

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

    public function deleteAll(): void
    {
        $this->departments = [];
    }
}
