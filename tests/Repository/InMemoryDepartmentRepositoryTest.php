<?php

declare(strict_types = 1);

namespace Example\Tests\Repository;

use Example\App\Repository\DepartmentRepository;

class InMemoryDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        return new InMemoryDepartmentRepository();
    }
}
