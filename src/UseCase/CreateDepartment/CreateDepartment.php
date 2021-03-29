<?php

declare(strict_types = 1);

namespace Example\App\UseCase\CreateDepartment;

use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\ValueObject\DepartmentId;

class CreateDepartment
{
    public function __construct(private DepartmentRepository $repository)
    {
    }

    public function execute(CreateDepartmentCommand $command): DepartmentCreatedDTO
    {
        $entity = new Department(new DepartmentId(), $command->name());
        $this->repository->add($entity);

        return new DepartmentCreatedDTO($entity->id());
    }
}
