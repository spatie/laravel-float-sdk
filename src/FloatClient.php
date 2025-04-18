<?php

namespace Spatie\FloatSdk;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Spatie\FloatSdk\Groups\AllocationsGroup;
use Spatie\FloatSdk\Groups\ClientsGroup;
use Spatie\FloatSdk\Groups\ProjectsGroup;
use Spatie\FloatSdk\Groups\ProjectTasksGroup;
use Spatie\FloatSdk\Groups\UsersGroup;

class FloatClient extends Connector
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
