<?php

namespace Spatie\FloatSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\FloatSdk\Float
 */
class FloatSdk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Spatie\FloatSdk\Float::class;
    }
}
