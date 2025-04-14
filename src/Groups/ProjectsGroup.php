<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetProjectsParameters;
use Spatie\FloatSdk\Requests\GetProject;
use Spatie\FloatSdk\Requests\GetProjects;

class ProjectsGroup extends BaseResource
{
    public function get(int $projectId): Response
    {
        return $this->connector->send(new GetProject($projectId));
    }

    public function all(?GetProjectsParameters $parameters = null): Response
    {
        return $this->connector->send(new GetProjects($parameters));
    }
}
