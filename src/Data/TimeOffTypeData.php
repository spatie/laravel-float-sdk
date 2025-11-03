<?php

namespace Spatie\FloatSdk\Data;

class TimeOffTypeData
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['timeoff_type_id'],
            name: $response['timeoff_type_name'],
        );
    }
}
