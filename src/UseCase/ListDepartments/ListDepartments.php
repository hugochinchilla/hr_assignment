<?php

declare(strict_types = 1);

namespace Example\App\UseCase\ListDepartments;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\Entity\Employee;
use Example\App\UseCase\CollectionDTO;

class ListDepartments
{
    public function __construct(private DepartmentRepository $departmentRepository)
    {
    }

    public function execute(): CollectionDTO
    {
        $departments = $this->departmentRepository->all();

        return new CollectionDTO(array_map(fn (Department $d): DepartmentDTO => $this->toDTO($d), $departments));
    }

    private function toDTO(Department $department): DepartmentDTO
    {
        return new DepartmentDTO(
            $department->id()->toString(),
            $department->name(),
            array_map(fn (Employee $e): EmployeeDTO => $this->toEmployeeDTO($e), $department->employees())
        );
    }

    private function toEmployeeDTO(Employee $e): EmployeeDTO
    {
        return new EmployeeDTO($e->name(), $e->salary());
    }
}
