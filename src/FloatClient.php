<?php

namespace Spatie\FloatSdk;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\Groups\AllocationsGroup;
use Spatie\FloatSdk\Groups\ClientsGroup;
use Spatie\FloatSdk\Groups\ProjectsGroup;
use Spatie\FloatSdk\Groups\ProjectTasksGroup;
use Spatie\FloatSdk\Groups\UsersGroup;

class FloatClient extends Connector implements HasPagination
{
    public function __construct(
        private string $apiKey,
        private string $userAgent,
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://api.float.com/v3';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'User-Agent' => $this->userAgent,
        ];
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiKey);
    }

    public function paginate(Request $request): Paginator
    {
        return new class(connector: $this, request: $request) extends Paginator
        {
            protected function isLastPage(Response $response): bool
            {
                return $response->header('X-Pagination-Page-Count') === $response->header('X-Pagination-Current-Page');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto();
            }

            protected function applyPagination(Request $request): Request
            {
                $request->query()->add('page', $this->currentPage);

                if (isset($this->perPageLimit)) {
                    $request->query()->add('per-page', $this->perPageLimit);
                }

                return $request;
            }
        };
    }

    public function users(): UsersGroup
    {
        return new UsersGroup($this);
    }

    public function projects(): ProjectsGroup
    {
        return new ProjectsGroup($this);
    }

    public function projectTasks(): ProjectTasksGroup
    {
        return new ProjectTasksGroup($this);
    }

    public function clients(): ClientsGroup
    {
        return new ClientsGroup($this);
    }

    public function allocations(): AllocationsGroup
    {
        return new AllocationsGroup($this);
    }
}
