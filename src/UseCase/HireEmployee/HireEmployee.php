<?php

declare(strict_types = 1);

namespace Example\App\UseCase\HireEmployee;

use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\Entity\Employee;

class HireEmployee
{
    public function __construct(private DepartmentRepository $departmentRepository)
    {
    }

    public function execute(HireEmployeeCommand $command): void
    {
        $department = $this->departmentRepository->getById($command->departmentId());
        $department->addEmployee(new Employee($command->name(), $command->salary()));
        $this->departmentRepository->update($department);
    }
}
