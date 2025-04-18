<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetProjectTasksParams;
use Spatie\FloatSdk\Resources\ProjectTaskResource;

class GetProjectTasks extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetProjectTasksParams $parameters = null
    ) {}

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    public function resolveEndpoint(): string
    {
        return '/project-tasks';
    }

    /** @return array<ProjectTaskResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return ProjectTaskResource::createFromResponse($object);
        }, $response->json());
    }
}
