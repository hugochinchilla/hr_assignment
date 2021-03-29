<?php

declare(strict_types = 1);

namespace Example\App\Infrastructure;

use Doctrine\DBAL\Connection;
use Example\App\Domain\Entity\Department;
use Example\App\Domain\Entity\DepartmentRepository;
use Example\App\Domain\Entity\Employee;
use Example\App\Domain\ValueObject\DepartmentId;
use Ramsey\Uuid\Uuid;

class DbalDepartmentRepository implements DepartmentRepository
{
    public function __construct(private Connection $conn)
    {
    }

    public function all(): array
    {
        return iterator_to_array($this->generateAll());
    }

    public function add(Department $department): void
    {
        $departmentId = $this->idToStorageFormat($department->id());

        $this->conn->insert('departments', [
            'id' => $departmentId,
            'name' => $department->name(),
        ]);

        foreach ($department->employees() as $employee) {
            $this->conn->insert('employees', [
                'department_id' => $departmentId,
                'id' => Uuid::uuid4()->getBytes(),
                'name' => $employee->name(),
                'salary' => $employee->salary(),
            ]);
        }
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
            $department = new Department($this->idFromStorageFormat($row['id']), $row['name']);
            $this->loadDeparmtnetEmployees($department);

            yield $department;
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

    private function loadDeparmtnetEmployees(Department $department): void
    {
        $stmt = $this->conn->prepare('SELECT name, salary FROM employees WHERE department_id=:department_id');
        $stmt->execute(['department_id' => $this->idToStorageFormat($department->id())]);
        $cursor = $stmt->execute();

        foreach ($cursor->fetchAllAssociative() as $row) {
            $employee = new Employee($row['name'], (int) $row['salary']);
            $department->addEmployee($employee);
        }
    }
}
