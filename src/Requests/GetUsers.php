<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Data\UserData;
use Spatie\FloatSdk\QueryParameters\GetUsersParams;

class GetUsers extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetUsersParams $parameters = null
    ) {}

    public function resolveEndpoint(): string
    {
        return '/people';
    }

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    /** @return array<UserData> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return UserData::createFromResponse($object);
        }, $response->json());
    }
}
