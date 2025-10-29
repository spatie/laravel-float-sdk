<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\FloatSdk\Concerns\HasPaginationAndSort;

class GetAllocationsParams
{
    use HasPaginationAndSort;

    /**
     * @param  ?array<string>  $fields
     * @param  ?array<string>  $expand
     */
    public function __construct(
        public ?int $clientId = null,
        public ?int $projectId = null,
        public ?int $phaseId = null,
        public ?int $taskMetaId = null,
        public ?int $peopleId = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?int $billable = null,
        public ?int $status = null,
        public ?int $repeatState = null,
        public ?string $modifiedSince = null,
        public ?array $fields = null,
        public ?string $expand = null,
        ?int $page = null,
        ?int $perPage = null,
        ?string $sort = null,
    ) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->sort = $sort;
    }

    /**
     * @return array<string, string|int|null>
     */
    public function toArray(): array
    {
        return array_filter([
            'client_id' => $this->clientId,
            'project_id' => $this->projectId,
            'phase_id' => $this->phaseId,
            'task_meta_id' => $this->taskMetaId,
            'people_id' => $this->peopleId,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'billable' => $this->billable,
            'status' => $this->status,
            'repeat_state' => $this->repeatState,
            'modified_since' => $this->modifiedSince,
            'fields' => $this->fields ? implode(',', $this->fields) : null,
            'expand' => $this->expand ?? null,
            'page' => $this->page,
            'per-page' => $this->perPage,
            'sort' => $this->sort,
        ], fn ($value) => $value !== null);
    }
}
