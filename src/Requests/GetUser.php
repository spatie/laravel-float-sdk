<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\UserResource;

class GetUser extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return "/people/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): UserResource
    {
        return UserResource::createFromResponse($response->json());
    }
}
