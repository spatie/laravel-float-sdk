<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\TaskResource;

class GetTasks extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/project-tasks';
    }

    /** @return array<TaskResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return TaskResource::createFromResponse($object);
        }, $response->json());
    }
}
