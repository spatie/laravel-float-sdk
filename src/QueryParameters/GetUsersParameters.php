<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class GetUsersParameters extends Data
{
    /**
     * @param  Optional|array<string>|null  $fields
     * @param  Optional|array<string>|null  $expand
     */
    public function __construct(
        public readonly Optional|bool|null $active = null,
        public readonly Optional|int|null $departmentId = null,
        public readonly Optional|string|null $email = null,
        public readonly Optional|int|null $peopleTypeId = null,
        public readonly Optional|int|null $employeeTypeId = null,
        public readonly Optional|string|null $tagName = null,
        public readonly Optional|int|null $page = 1,
        public readonly Optional|int|null $perPage = 50,
        public readonly Optional|string|null $sort = null,
        public readonly Optional|string|null $modifiedSince = null,
        public readonly Optional|array|null $fields = null,
        public readonly Optional|array|null $expand = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'active' => $this->active ? 1 : 0,
            'department_id' => $this->departmentId,
            'email' => $this->email,
            'people_type_id' => $this->peopleTypeId,
            'employee_type_id' => $this->employeeTypeId,
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
