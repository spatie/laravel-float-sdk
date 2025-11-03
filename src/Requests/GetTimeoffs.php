<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Spatie\FloatSdk\Data\TimeOffData;

class GetTimeoffs extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/timeoffs';
    }

    protected function defaultQuery(): array
    {
        return [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ];
    }

    /**
     * @return array<TimeOffData>
     *
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return TimeOffData::createFromResponse($object);
        }, $response->json());
    }
}
