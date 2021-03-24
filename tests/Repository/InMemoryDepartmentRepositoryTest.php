<?php

namespace Example\Tests\Repository;

use Example\App\Repository\DepartmentRepository;

class InMemoryDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        return new InMemoryDepartmentRepository();
    }
}
