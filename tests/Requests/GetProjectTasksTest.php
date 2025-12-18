<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetProjectTask;
use Spatie\FloatSdk\Requests\GetProjectTasks;

beforeEach(function () {
    $this->projectTasks = [
        ['task_meta_id' => 1, 'task_name' => 'Development', 'project_id' => 100],
        ['task_meta_id' => 2, 'task_name' => 'Design', 'project_id' => 100],
        ['task_meta_id' => 3, 'task_name' => 'Testing', 'project_id' => 101],
    ];

    $this->singleProjectTask = ['task_meta_id' => 1, 'task_name' => 'Development', 'project_id' => 100];

    $this->mockClient = new MockClient([
        GetProjectTasks::class => MockResponse::make(body: $this->projectTasks),
        GetProjectTask::class => MockResponse::make(body: $this->singleProjectTask),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all project tasks', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetProjectTasks);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);

    $firstTask = $response->json()[0];

    expect($firstTask)
        ->toHaveKeys(['task_meta_id', 'task_name', 'project_id']);
});

it('can fetch all project tasks via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->projectTasks()->all();

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);
});

it('can fetch a single project task', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetProjectTask(1));

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['task_meta_id', 'task_name', 'project_id']);

    expect($response->json()['task_meta_id'])->toBe(1);
});

it('can fetch a single project task via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->projectTasks()->get(1);

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['task_meta_id', 'task_name', 'project_id']);
});
