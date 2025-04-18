<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Spatie\FloatSdk\QueryParameters\GetAllocationsParams;
use Spatie\FloatSdk\Resources\TaskResource;

class GetAllocations extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetAllocationsParams $parameters = null
    ) {}

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    public function resolveEndpoint(): string
    {
        return '/tasks';
    }

    /** @return array<int, TaskResource> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(
            fn (array $object) => TaskResource::createFromResponse($object),
            $response->json()
        );
    }
}
