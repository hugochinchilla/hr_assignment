<?php

declare(strict_types = 1);

namespace Example\App\UseCase\CreateDepartment;

use Example\App\Domain\ValueObject\DepartmentId;
use Example\App\UseCase\DTO;

class DepartmentCreatedDTO implements DTO
{
    public function __construct(private DepartmentId $id)
    {
    }

    public function id(): DepartmentId
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return ['id' => $this->id->toString()];
    }
}
