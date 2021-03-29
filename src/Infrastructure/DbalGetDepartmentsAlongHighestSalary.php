<?php

declare(strict_types = 1);

namespace Example\App\Infrastructure;

use Doctrine\DBAL\Connection;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\DepartmentWithSalaryEntry;
use Example\App\UseCase\GetDepartmentsAlongHighestSalary\GetDepartmentsAlongHighestSalaryInterface;

class DbalGetDepartmentsAlongHighestSalary implements GetDepartmentsAlongHighestSalaryInterface
{
    public function __construct(private Connection $connection)
    {
    }

    public function execute(): array
    {
        return iterator_to_array($this->generateResults());
    }

    private function generateResults(): \Generator
    {
        $stmt = $this->connection->prepare(
            '
            SELECT
                d.name, COALESCE(MAX(e.salary), 0) as salary
            FROM departments d
            LEFT JOIN employees e ON d.id = e.department_id
            GROUP BY d.id
        '
        );
        $stmt->execute();
        $cursor = $stmt->execute();

        foreach ($cursor->fetchAllAssociative() as $row) {
            yield new DepartmentWithSalaryEntry($row['name'], (int) $row['salary']);
        }
    }
}
