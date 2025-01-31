<?php

namespace Spatie\FloatSdk\Resources;

class UserResource
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $jobTitle,
        public bool $active
    ) {}

    /** @param array<mixed> $user */
    public static function createFromResponse(array $user): self
    {
        return new self(
            id: $user['people_id'],
            name: $user['name'],
            email: $user['email'],
            jobTitle: $user['job_title'],
            active: $user['active'],
        );
    }
}
