<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\Requests\GetProjects;

class ProjectsGroup extends BaseResource
{
    public function all(): Response
    {
        return $this->connector->send(new GetProjects());
    }
}
