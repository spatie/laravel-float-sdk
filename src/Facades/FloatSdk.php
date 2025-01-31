<?php

namespace Spatie\FloatSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\FloatSdk\FloatSdk
 */
class FloatSdk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Spatie\FloatSdk\FloatSdk::class;
    }
}
