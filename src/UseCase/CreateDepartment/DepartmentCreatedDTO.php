<?php

declare(strict_types = 1);

namespace Example\App\UseCase\CreateDepartment;

use Example\App\Domain\ValueObject\DepartmentId;

class DepartmentCreatedDTO
{
    public function __construct(private DepartmentId $id)
    {
    }

    public function id(): DepartmentId
    {
        return $this->id;
    }
}
