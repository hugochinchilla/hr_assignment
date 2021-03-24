<?php

declare(strict_types = 1);

namespace Example\App\Repository;

use Example\App\Entity\Department;

interface DepartmentRepository
{
    /**
     * @return Department[]
     */
    public function all(): array;

    public function add(Department $department): void;
}
