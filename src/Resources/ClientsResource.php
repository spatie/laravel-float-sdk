<?php

namespace Spatie\FloatSdk\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\QueryParameters\GetClientsParams;
use Spatie\FloatSdk\Requests\GetClient;
use Spatie\FloatSdk\Requests\GetClients;

/** @property FloatClient $connector */
class ClientsResource extends BaseResource
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
