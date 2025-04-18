<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetAllocationsParameters;
use Spatie\FloatSdk\Resources\TaskResource;

class GetAllocations extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetAllocationsParameters $parameters = null
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
