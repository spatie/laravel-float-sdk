<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetClientsParameters;
use Spatie\FloatSdk\Requests\GetClients;
use Spatie\FloatSdk\Requests\GetProject;

class ClientsGroup extends BaseResource
{
    public function all(?GetClientsParameters $parameters = null): Response
    {
        return $this->connector->send(new GetClients($parameters));
    }
}
