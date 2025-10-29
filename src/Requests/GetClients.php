<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Spatie\FloatSdk\Data\ClientData;
use Spatie\FloatSdk\QueryParameters\GetClientsParams;

class GetClients extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetClientsParams $parameters = null
    ) {}

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    public function resolveEndpoint(): string
    {
        return '/clients';
    }

    /** @return array<ClientData> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return ClientData::createFromResponse($object);
        }, $response->json());
    }
}
