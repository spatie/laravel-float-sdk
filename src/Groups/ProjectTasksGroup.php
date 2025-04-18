<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetProjectTasksParams;
use Spatie\FloatSdk\Requests\GetProjectTask;
use Spatie\FloatSdk\Requests\GetProjectTasks;

class ProjectTasksGroup extends BaseResource
{
    public function get(int $taskId): Response
    {
        return $this->connector->send(new GetProjectTask($taskId));
    }

    public function all(?GetProjectTasksParams $parameters = null): Response
    {
        return $this->connector->send(new GetProjectTasks($parameters));
    }
}
