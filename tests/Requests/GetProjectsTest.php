<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetProject;
use Spatie\FloatSdk\Requests\GetProjects;

beforeEach(function () {
    $this->projects = [
        ['project_id' => 1, 'name' => 'Website Redesign', 'client_id' => 100],
        ['project_id' => 2, 'name' => 'Mobile App', 'client_id' => 101],
        ['project_id' => 3, 'name' => 'Internal Tool', 'client_id' => null],
    ];

    $this->singleProject = ['project_id' => 1, 'name' => 'Website Redesign', 'client_id' => 100];

    $this->mockClient = new MockClient([
        GetProjects::class => MockResponse::make(body: $this->projects),
        GetProject::class => MockResponse::make(body: $this->singleProject),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all projects', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetProjects);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);

    $firstProject = $response->json()[0];

    expect($firstProject)
        ->toHaveKeys(['project_id', 'name', 'client_id']);
});

it('can fetch all projects via resource', function () {
    $paginator = $this->client
        ->withMockClient($this->mockClient)
        ->projects()->all();

    expect($paginator)->toBeInstanceOf(\Saloon\PaginationPlugin\Paginator::class);
});

it('can fetch a single project', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetProject(1));

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['project_id', 'name', 'client_id']);

    expect($response->json()['project_id'])->toBe(1);
});

it('can fetch a single project via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->projects()->get(1);

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['project_id', 'name', 'client_id']);
});
