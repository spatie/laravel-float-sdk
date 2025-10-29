<?php

namespace Spatie\FloatSdk\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;
use Spatie\FloatSdk\Requests\GetProject;
use Spatie\FloatSdk\Requests\GetProjects;

class ProjectsResource extends BaseResource
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
