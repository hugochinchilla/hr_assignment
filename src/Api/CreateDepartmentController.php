<?php

declare(strict_types = 1);

namespace Example\App\Api;

use Example\App\UseCase\CreateDepartment\CreateDepartment;
use Example\App\UseCase\CreateDepartment\CreateDepartmentCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateDepartmentController
{
    #[Route(path: '/v1/departments', name: 'create_department', methods: ['POST'])]
    public function createDepartment(Request $request, CreateDepartment $createDepartment): JsonResponse
    {
        $result = $createDepartment->execute(new CreateDepartmentCommand($request->get('name')));

        return new JsonResponse($result->toArray(), Response::HTTP_CREATED);
    }
}
