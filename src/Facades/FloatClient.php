<?php

namespace Spatie\FloatSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\FloatSdk\FloatClient
 */
class FloatClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Spatie\FloatSdk\FloatClient::class;
    }
}
