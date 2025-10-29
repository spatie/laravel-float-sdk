<?php

namespace Spatie\FloatSdk\Data;

class UserData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $jobTitle,
        public bool $active
    ) {}

    /** @param array<string, mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['people_id'],
            name: $response['name'],
            email: $response['email'],
            jobTitle: $response['job_title'],
            active: $response['active'],
        );
    }
}
