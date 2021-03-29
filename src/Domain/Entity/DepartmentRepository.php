<?php

declare(strict_types = 1);

namespace Example\App\Domain\Entity;

use Example\App\Domain\ValueObject\DepartmentId;

interface DepartmentRepository
{
    /**
     * @return Department[]
     */
    public function all(): array;

    public function getById(DepartmentId $id): Department;

    public function add(Department $department): void;

    public function update(Department $department): void;

    public function deleteAll(): void;
}
