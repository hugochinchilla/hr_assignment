<?php

declare(strict_types = 1);

use Example\App\Infrastructure\DbalConnectionFactory;
use Example\Tests\Helpers\WaitForMariadb;

$migrationDir = __DIR__ . '/../migrations/';
$migrationFiles = [
    $migrationDir . '000-create-departments-table.sql',
    $migrationDir . '001-create-employees-table.sql',
];

$conn = (new DbalConnectionFactory())->test();

(new WaitForMariadb($conn))->__invoke();

foreach ($migrationFiles as $migration) {
    $sql = (string) file_get_contents($migration);
    $conn->executeStatement($sql);
}
