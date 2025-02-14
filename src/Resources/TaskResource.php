<?php

namespace Spatie\FloatSdk\Resources;

class TaskResource
{
    public function __construct(
        public int $id,
        public string $name,
        public string $projectId,
    ) {}

    /** @param array<mixed> $response */
    public static function createFromResponse(array $response): self
    {
        return new self(
            id: $response['task_meta_id'],
            name: $response['task_name'],
            projectId: $response['project_id'],
        );
    }
}
