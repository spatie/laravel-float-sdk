<?php

namespace Spatie\FloatSdk\QueryParameters;

use Spatie\FloatSdk\Concerns\HasPaginationAndSort;

class GetClientsParams
{
    use HasPaginationAndSort;

    /**
     * @param  ?array<int, string>  $fields
     * @param  ?array<int, string>  $expand
     */
    public function __construct(
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
            'page' => $this->page,
            'per-page' => $this->perPage,
            'sort' => $this->sort,
            'fields' => $this->fields ? implode(',', $this->fields) : null,
            'expand' => $this->expand ? implode(',', $this->expand) : null,
        ], fn ($value) => $value !== null);
    }
}
