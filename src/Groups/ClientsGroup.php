<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\PaginationPlugin\Paginator;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetClientsParams;
use Spatie\FloatSdk\Requests\GetClient;
use Spatie\FloatSdk\Requests\GetClients;

class ClientsGroup extends BaseResource
{
    public function get(int $clientId): Response
    {
        return $this->connector->send(new GetClient($clientId));
    }

    public function all(?GetClientsParams $parameters = null): Paginator
    {
        return $this->connector->paginate(new GetClients($parameters));
    }
}
