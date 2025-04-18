<?php

namespace Spatie\FloatSdk\Groups;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Spatie\FloatSdk\QueryParameters\GetAllocationsParameters;
use Spatie\FloatSdk\Requests\GetAllocation;
use Spatie\FloatSdk\Requests\GetAllocations;

class AllocationsGroup extends BaseResource
{
    public function get(int $allocationId): Response
    {
        return $this->connector->send(new GetAllocation($allocationId));
    }

    public function all(?GetAllocationsParameters $parameters = null): Response
    {
        return $this->connector->send(new GetAllocations($parameters));
    }
}
