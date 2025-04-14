<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\TaskResource;

class GetTask extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return "/project-tasks/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): TaskResource
    {
        return TaskResource::createFromResponse($response->json());
    }
}
