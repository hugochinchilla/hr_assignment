<?php

declare(strict_types = 1);

namespace Example\Tests\Infrastructure;

use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Infrastructure\DbalConnectionFactory;
use Example\App\Infrastructure\DbalDepartmentRepository;

class DbalDepartmentRepositoryTest extends DepartmentRepositoryTest
{
    protected function getImplementation(): DepartmentRepository
    {
        $conn = (new DbalConnectionFactory())->test();

        return new DbalDepartmentRepository($conn);
    }
}
