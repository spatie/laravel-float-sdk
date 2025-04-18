<?php

namespace Spatie\FloatSdk\Groups;

use Generator;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;
use Spatie\FloatSdk\Requests\GetProject;
use Spatie\FloatSdk\Requests\GetProjects;

class ProjectsGroup extends BaseResource
{
    public function get(int $projectId): Response
    {
        return $this->connector->send(new GetProject($projectId));
    }

    public function all(?GetProjectsParams $parameters = null): Generator
    {
        $paginator = $this->connector->paginate(new GetProjects($parameters));

        foreach ($paginator->paginate() as $response) {
            yield $response;
        }
    }
}
