<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetTasksParameters;
use Spatie\FloatSdk\Requests\GetTask;
use Spatie\FloatSdk\Requests\GetTasks;

class TasksGroup extends BaseResource
{
    public function get(int $taskId): Response
    {
        return $this->connector->send(new GetTask($taskId));
    }

    public function all(?GetTasksParameters $parameters = null): Response
    {
        return $this->connector->send(new GetTasks($parameters));
    }
}
