<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\GetDepartmentsAlongHighestSalary;

use Doctrine\DBAL\Connection;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Infrastructure\DbalConnectionFactory;
use Example\App\Infrastructure\DbalDepartmentRepository;
use Example\App\Infrastructure\DbalGetDepartmentsAlongHighestSalary;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\GetDepartmentsAlongHighestSalaryInterface;

class DbalGetDepartmentsAlongHighestSalaryTest extends AbstractGetDepartmentsAlongHighestSalaryTest
{
    private ?Connection $connection = null;

    public function getImplementation(): GetDepartmentsAlongHighestSalaryInterface
    {
        return new DbalGetDepartmentsAlongHighestSalary($this->connection());
    }

    public function getRepository(): DepartmentRepository
    {
        return new DbalDepartmentRepository($this->connection());
    }

    private function connection(): Connection
    {
        if ($this->connection === null) {
            $this->connection = (new DbalConnectionFactory())->test();
        }

        return $this->connection;
    }
}
