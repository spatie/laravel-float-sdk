<?php

namespace Spatie\FloatSdk\Data;

class PublicHolidayData
{
    /**
     * @param  array<string>  $dates
     */
    public function __construct(
        public int $id,
        public string $name,
        public array $dates,
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['id'],
            name: $response['name'],
            dates: $response['dates'],
        );
    }
}
