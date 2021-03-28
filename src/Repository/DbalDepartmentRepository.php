<?php

declare(strict_types = 1);

namespace Example\App\Repository;

use Example\App\Entity\Department;
use Example\App\Entity\DepartmentId;
use Ramsey\Uuid\Uuid;

class DbalDepartmentRepository implements DepartmentRepository
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
            'id' => $this->idToStorageFormat($department->id()),
            'name' => $department->name(),
        ]);
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    private function generateAll(): \Generator
    {
        $stmt = $this->conn->prepare('SELECT id, name FROM departments');
        $stmt->execute();
        $cursor = $stmt->execute();

        foreach ($cursor->fetchAllAssociative() as $row) {
            yield new Department($this->idFromStorageFormat($row['id']), $row['name']);
        }
    }

    public function deleteAll(): void
    {
        $this->conn->executeQuery('DELETE FROM departments');
    }

    private function idToStorageFormat(DepartmentId $id): string
    {
        return Uuid::fromString($id->toString())->getBytes();
    }

    private function idFromStorageFormat(string $id): DepartmentId
    {
        return DepartmentId::fromString(Uuid::fromBytes($id)->toString());
    }
}
