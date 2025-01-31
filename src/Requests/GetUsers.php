<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\UserResource;

class GetUsers extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/people';
    }

    /** @return array<UserResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return UserResource::createFromResponse($object);
        }, $response->json());
    }
}
