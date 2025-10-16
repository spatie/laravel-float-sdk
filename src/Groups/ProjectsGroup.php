<?php

namespace Spatie\FloatSdk\Groups;

use Generator;
use Saloon\Http\Response;
use Saloon\Http\BaseResource;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\Requests\GetProject;
use Spatie\FloatSdk\Requests\GetProjects;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;

class ProjectsGroup extends BaseResource
{
    public function get(int $projectId): Response
    {
        return $this->connector->send(new GetProject($projectId));
    }

    public function all(?GetProjectsParams $parameters = null): Paginator
    {
        return $this->connector->paginate(new GetProjects($parameters));
    }
}
