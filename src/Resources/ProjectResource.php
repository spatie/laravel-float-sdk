<?php

namespace Spatie\FloatSdk\Resources;

class ProjectResource
{
    public function __construct(
        public int $id,
        public string $name,
        public ?int $clientId,
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['project_id'],
            name: $response['name'],
            clientId: $response['client_id'],
        );
    }
}
