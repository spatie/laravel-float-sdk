<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\FloatSdk\Concerns\HasPaginationAndSort;

class GetTasksParameters
{
    use HasPaginationAndSort;

    /**
     * @param  array<string>|null  $fields
     */
    public function __construct(
        public ?int $projectId = null,
        public ?bool $billable = null,
        public ?array $fields = null,
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
            'project_id' => $this->projectId,
            'billable' => $this->billable ? 1 : 0,
            'page' => $this->page,
            'per-page' => $this->perPage,
            'sort' => $this->sort,
            'fields' => $this->fields ? implode(',', $this->fields) : null,
        ], fn ($value) => $value !== null);
    }
}
