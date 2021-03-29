<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\GetDepartmentsAlongHighestSalary;

use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\GetDepartmentsAlongHighestSalaryInterface;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\InMemoryGetDepartmentsAlongHighestSalary;
use Example\Tests\Infrastructure\InMemoryDepartmentRepository;

class InMemoryGetDepartmentsAlongHighestSalaryTest extends AbstractGetDepartmentsAlongHighestSalaryTest
{
    private ?DepartmentRepository $repositorySingleton = null;

    public function getImplementation(): GetDepartmentsAlongHighestSalaryInterface
    {
        return new InMemoryGetDepartmentsAlongHighestSalary($this->getRepository());
    }

    public function getRepository(): DepartmentRepository
    {
        if ($this->repositorySingleton === null) {
            $this->repositorySingleton = new InMemoryDepartmentRepository();
        }

        return $this->repositorySingleton;
    }
}
