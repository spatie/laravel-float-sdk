<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Data\AllocationData;

class GetAllocation extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return "/tasks/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): AllocationData
    {
        return AllocationData::createFromResponse($response->json());
    }
}
