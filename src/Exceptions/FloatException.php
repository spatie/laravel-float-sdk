<?php

namespace Spatie\FloatSdk\Exceptions;

class FloatException extends \RuntimeException
{
    public static function missingApiToken():self
    {
        return new self('No Float API token was provided. Make sure to set the `FLOAT_API_TOKEN` environment variable.');
    }

    public static function missingUserAgent(): self
    {
        return new self('Float requires a User-Agent header in the format: `YourAppName (your-email@example.com)`. Please set the `FLOAT_USER_AGENT` environment variable accordingly.');
    }
}
