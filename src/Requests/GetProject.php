<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Spatie\FloatSdk\Data\ProjectData;

class GetProject extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return "/projects/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): ProjectData
    {
        return ProjectData::createFromResponse($response->json());
    }
}
