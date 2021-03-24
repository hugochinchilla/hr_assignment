<?php

namespace Example\Tests\Repository;

use Example\App\Repository\DepartmentRepository;
use Example\App\Repository\DoctrineDepartmentRepository;

class DoctrineDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        return new DoctrineDepartmentRepository();
    }
}
