<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Resources\ClientResource;

class GetClient extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return "/clients/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): ClientResource
    {
        return ClientResource::createFromResponse($response->json());
    }
}
