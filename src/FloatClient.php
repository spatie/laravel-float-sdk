<?php

namespace Spatie\FloatSdk;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\Paginator;
use Spatie\FloatSdk\Resources\AllocationsResource;
use Spatie\FloatSdk\Resources\ClientsResource;
use Spatie\FloatSdk\Resources\ProjectsResource;
use Spatie\FloatSdk\Resources\ProjectTasksResource;
use Spatie\FloatSdk\Resources\PublicHolidaysResource;
use Spatie\FloatSdk\Resources\TimeOffResource;
use Spatie\FloatSdk\Resources\UsersResource;

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

    public function users(): UsersResource
    {
        return new UsersResource($this);
    }

    public function projects(): ProjectsResource
    {
        return new ProjectsResource($this);
    }

    public function projectTasks(): ProjectTasksResource
    {
        return new ProjectTasksResource($this);
    }

    public function clients(): ClientsResource
    {
        return new ClientsResource($this);
    }

    public function allocations(): AllocationsResource
    {
        return new AllocationsResource($this);
    }

    public function publicHolidays(): PublicHolidaysResource
    {
        return new PublicHolidaysResource($this);
    }

    public function timeOff(): TimeOffResource
    {
        return new TimeOffResource($this);
    }
}
