<?php

declare(strict_types = 1);

namespace Example\App\Repository;

use Example\App\Entity\Department;
use Ramsey\Uuid\Uuid;

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
        return iterator_to_array($this->generateAll());
    }

    public function add(Department $department): void
    {
        $this->conn->insert('departments', [
            'id' => Uuid::uuid4()->getBytes(),
            'name' => $department->name()
        ]);
    }

    /**
     * @return \Generator
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    private function generateAll(): \Generator
    {
        $stmt = $this->conn->prepare("SELECT name FROM departments");
        $stmt->execute();
        $cursor = $stmt->execute();

        foreach ($cursor->fetchAllAssociative() as $row) {
            yield new Department($row['name']);
        };
    }

    public function deleteAll(): void
    {
        $this->conn->executeQuery('DELETE FROM departments');
    }
}
