<?php

declare(strict_types = 1);

namespace Example\Tests\Infrastructure;

use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Infrastructure\DbalDepartmentRepository;

class DbalDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        return new DbalDepartmentRepository();
    }
}
