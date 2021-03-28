<?php

declare(strict_types = 1);

namespace Example\App\Domain\Entity;

interface DepartmentRepository
{
    /**
     * @return Department[]
     */
    public function all(): array;

    public function add(Department $department): void;

    public function deleteAll(): void;
}
