<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\ProjectResource;

class GetProjects extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/projects';
    }

    /** @return array<ProjectResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return ProjectResource::createFromResponse($object);
        }, $response->json());
    }
}
