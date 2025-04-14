<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetClientsParameters;
use Spatie\FloatSdk\Resources\ClientResource;

class GetClients extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetClientsParameters $parameters = null
    ) {}

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    public function resolveEndpoint(): string
    {
        return '/clients';
    }

    /** @return array<ClientResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return ClientResource::createFromResponse($object);
        }, $response->json());
    }
}

