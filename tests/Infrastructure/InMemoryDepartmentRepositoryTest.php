<?php

declare(strict_types = 1);

namespace Example\Tests\Infrastructure;

use Example\App\Domain\Entity\DepartmentRepository;

class InMemoryDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        return new InMemoryDepartmentRepository();
    }
}
