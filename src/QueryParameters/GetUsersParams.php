<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\FloatSdk\Concerns\HasPaginationAndSort;

class GetUsersParams
{
    use HasPaginationAndSort;

    /**
     * @param  ?array<string>  $fields
     * @param  ?array<string>  $expand
     */
    public function __construct(
        public ?bool $active = null,
        public ?int $departmentId = null,
        public ?string $email = null,
        public ?int $peopleTypeId = null,
        public ?int $employeeTypeId = null,
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
            'active' => $this->active ? 1 : 0,
            'department_id' => $this->departmentId,
            'email' => $this->email,
            'people_type_id' => $this->peopleTypeId,
            'employee_type_id' => $this->employeeTypeId,
            'tag_name' => $this->tagName,
            'modified_since' => $this->modifiedSince,
            'fields' => $this->fields ? implode(',', $this->fields) : null,
            'expand' => $this->expand ? implode(',', $this->expand) : null,
            'page' => $this->page,
            'per-page' => $this->perPage,
            'sort' => $this->sort,
        ], fn ($value) => $value !== null);
    }
}
