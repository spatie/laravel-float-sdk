<?php

namespace Spatie\FloatSdk\Concerns;

trait HasPaginationAndSort
{
    public ?int $page = null;

    public ?int $perPage = null;

    public ?string $sort = null;
}
