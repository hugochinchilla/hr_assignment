<?php

declare(strict_types = 1);

namespace Example\App\Repository;

use Example\App\Entity\Department;

class DoctrineDepartmentRepository implements DepartmentRepository
{
    private \Doctrine\DBAL\Connection $conn;

    public function __construct()
    {
        $connectionParams = [
            'url' => 'mysql://root:example@mariadb/chessable_hr',
        ];
        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }

    public function all(): array
    {
        return [];
    }

    public function add(Department $department): void
    {

    }
}
