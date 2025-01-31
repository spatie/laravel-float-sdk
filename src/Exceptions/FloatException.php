<?php

namespace Spatie\FloatSdk\Exceptions;

class FloatException extends \RuntimeException
{
    public static function missingApiToken():self
    {
        return new self('No Float API token was provided. Make sure to set the `FLOAT_API_TOKEN` environment variable.');
    }

    public static function missingEndpoint(): self
    {
        return new self('No Float endpoint was provided. Make sure to set the `FLOAT_ENDPOINT` environment variable.');
    }
}
