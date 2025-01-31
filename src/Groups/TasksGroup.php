<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\Requests\GetTasks;

class TasksGroup extends BaseResource
{
    public function all(): Response
    {
        return $this->connector->send(new GetTasks);
    }
}
