<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase\CreateDepartment;

use Example\App\Domain\Entity\Department;
use Example\App\UseCase\CreateDepartment\CreateDepartment;
use Example\App\UseCase\CreateDepartment\CreateDepartmentCommand;
use Example\Tests\Infrastructure\InMemoryDepartmentRepository;
use PHPUnit\Framework\TestCase;

class CreateDepartmentTest extends TestCase
{
    /** @test */
    public function creating_a_department_returns_the_id(): void
    {
        $repository = new InMemoryDepartmentRepository();
        $createDepartment = new CreateDepartment($repository);
        $command = new CreateDepartmentCommand('IT');

        $result = $createDepartment->execute($command);

        $this->assertNotNull($result->id()->toString());
    }

    /** @test */
    public function the_created_department_is_persisted_in_the_repository(): void
    {
        $repository = new InMemoryDepartmentRepository();
        $createDepartment = new CreateDepartment($repository);
        $command = new CreateDepartmentCommand('IT');

        $result = $createDepartment->execute($command);

        $this->assertEquals($repository->all(), [
            new Department($result->id(), 'IT'),
        ]);
    }
}
