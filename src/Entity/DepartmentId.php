<?php

declare(strict_types = 1);

namespace Example\App\Entity;

use Ramsey\Uuid\Uuid;

class DepartmentId
{
    private $value;

    public function __construct()
    {
        $this->value = Uuid::uuid4();
    }

    public static function fromString(string $id): DepartmentId
    {
        $instance = new DepartmentId();
        $instance->value = Uuid::fromString($id);

        return $instance;
    }

    public function toString(): string
    {
        return $this->value->toString();
    }

    public function equals(DepartmentId $id): bool
    {
        return $id->toString() === $this->toString();
    }
}
