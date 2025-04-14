<?php

namespace Spatie\FloatSdk\Resources;

class ClientResource
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['client_id'],
            name: $response['name'],
        );
    }
}

