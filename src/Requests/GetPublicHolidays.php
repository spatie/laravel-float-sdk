<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use Spatie\FloatSdk\Data\ClientData;
use Spatie\FloatSdk\Data\PublicHolidayData;
use Spatie\FloatSdk\Data\UserData;

class GetPublicHolidays extends \Saloon\Http\Request
{
    protected Method $method = Method::GET;

    public function __construct(protected ?int $year) {}

    public function resolveEndpoint(): string
    {
        return "/public-holidays";
    }

    /** @return array<PublicHolidayData> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return PublicHolidayData::createFromResponse($object);
        }, $response->json());
    }
}
