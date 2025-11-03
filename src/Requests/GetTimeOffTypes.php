<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Data\TimeOffData;
use Spatie\FloatSdk\Data\TimeOffTypeData;

class GetTimeOffTypes extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/timeoff-types';
    }

    /**
     * @return array<TimeOffData>
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return TimeOffTypeData::createFromResponse($object);
        }, $response->json());
    }
}
