<?php

namespace Spatie\FloatSdk\Resources;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\Requests\GetPublicHolidays;

class PublicHolidaysResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function all(int $year): Response
    {
        return $this->connector->send(new GetPublicHolidays($year));
    }
}
