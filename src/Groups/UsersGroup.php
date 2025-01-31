<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\Requests\GetUsers;

class UsersGroup extends BaseResource
{
    public function all(): Response
    {
        return $this->connector->send(new GetUsers());
    }
}
