<?php

namespace Spatie\FloatSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Spatie\FloatSdk\Data\ProjectData;
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;

class GetProjects extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?GetProjectsParams $parameters = null
    ) {}

    protected function defaultQuery(): array
    {
        return $this->parameters ? $this->parameters->toArray() : [];
    }

    public function resolveEndpoint(): string
    {
        return '/projects';
    }

    /** @return array<int, ProjectData> */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $object) {
            return ProjectData::createFromResponse($object);
        }, $response->json());
    }
}
