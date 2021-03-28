<?php

declare(strict_types = 1);

namespace Example\App\Entity;

class Employee
{
    public function __construct(private string $name, private int $salary)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function salary(): int
    {
        return $this->salary;
    }
}
