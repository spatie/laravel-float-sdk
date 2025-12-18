<?php

namespace Spatie\FloatSdk\Resources;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetTimeoffs;
use Spatie\FloatSdk\Requests\GetTimeOffTypes;

/** @property FloatClient $connector */
class TimeOffResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function all(string $startDate, string $endDate): Paginator
    {
        return $this->connector->paginate(new GetTimeoffs($startDate, $endDate));
    }

    public function types(): Response
    {
        return $this->connector->send(new GetTimeOffTypes);
    }
}
