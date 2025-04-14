<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetUsersParameters;
use Spatie\FloatSdk\Requests\GetUser;
use Spatie\FloatSdk\Requests\GetUsers;

class UsersGroup extends BaseResource
{
    public function get(int $userId): Response
    {
        return $this->connector->send(new GetUser($userId));
    }

    public function all(?GetUsersParameters $parameters = null): Response
    {
        return $this->connector->send(new GetUsers($parameters));
    }
}
