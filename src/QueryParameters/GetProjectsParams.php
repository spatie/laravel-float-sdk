<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\FloatSdk\Concerns\HasPaginationAndSort;

class GetProjectsParams
{
    use HasPaginationAndSort;

    /**
     * @param  ?array<string>  $fields
     * @param  ?array<string>  $expand
     */
    public function __construct(
        public ?bool $active = null,
        public ?string $projectCode = null,
        public ?int $clientId = null,
        public ?bool $nonBillable = null,
        public ?string $tagName = null,
        public ?string $modifiedSince = null,
        public ?array $fields = null,
        public ?array $expand = null,
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
            'project_code' => $this->projectCode,
            'client_id' => $this->clientId,
            'active' => is_null($this->active) ? null : (int) $this->active,
            'nonBillable' => is_null($this->nonBillable) ? null : (int) $this->nonBillable,
            'tag_name' => $this->tagName,
            'page' => $this->page,
            'per-page' => $this->perPage,
            'sort' => $this->sort,
            'modified_since' => $this->modifiedSince,
            'fields' => $this->fields ? implode(',', $this->fields) : null,
            'expand' => $this->expand ? implode(',', $this->expand) : null,
        ], fn ($value) => $value !== null);
    }
}
