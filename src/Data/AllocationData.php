<?php

namespace Spatie\FloatSdk\Data;

/**
 * Note: The API refers to these as "tasks", but they model project allocations.
 */
class AllocationData
{
    public function __construct(
        public ?int $taskId,
        public ?int $rootTaskId,
        public ?int $parentTaskId,
        public ?int $projectId,
        public ?int $phaseId,
        public ?string $startDate,
        public ?string $endDate,
        public ?string $startTime,
        public ?float $hours,
        public ?int $peopleId,
        /** @var string[] */
        public array $peopleIds,
        public ?int $status,
        public ?int $billable,
        public ?string $name,
        public ?string $notes,
        public ?int $repeatState,
        public ?string $repeatEndDate,
        public ?int $createdBy,
        public ?string $created,
        public ?int $modifiedBy,
        public ?string $modified,
        public ?array $taskDays,
    ) {}

    /** @param array<string, mixed> $data */
    public static function createFromResponse(array $data): self
    {
        return new self(
            taskId: $data['task_id'] ?? null,
            rootTaskId: $data['root_task_id'] ?? null,
            parentTaskId: $data['parent_task_id'] ?? null,
            projectId: $data['project_id'] ?? null,
            phaseId: $data['phase_id'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            startTime: $data['start_time'] ?? null,
            hours: $data['hours'] ?? null,
            peopleId: $data['people_id'] ?? null,
            peopleIds: $data['people_ids'] ?? [],
            status: $data['status'] ?? null,
            billable: $data['billable'] ?? null,
            name: $data['name'] ?? null,
            notes: $data['notes'] ?? null,
            repeatState: $data['repeat_state'] ?? null,
            repeatEndDate: $data['repeat_end_date'] ?? null,
            createdBy: $data['created_by'] ?? null,
            created: $data['created'] ?? null,
            modifiedBy: $data['modified_by'] ?? null,
            modified: $data['modified'] ?? null,
            taskDays: $data['task_days'] ?? null,
        );
    }
}
