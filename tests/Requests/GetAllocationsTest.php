<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetAllocation;
use Spatie\FloatSdk\Requests\GetAllocations;

beforeEach(function () {
    $this->allocations = [
        [
            'task_id' => 1,
            'project_id' => 100,
            'people_id' => 10,
            'people_ids' => [10],
            'start_date' => '2025-01-01',
            'end_date' => '2025-01-05',
            'hours' => 8.0,
            'name' => 'Development work',
            'status' => 1,
            'billable' => 1,
        ],
        [
            'task_id' => 2,
            'project_id' => 101,
            'people_id' => 11,
            'people_ids' => [11],
            'start_date' => '2025-01-06',
            'end_date' => '2025-01-10',
            'hours' => 4.0,
            'name' => 'Design review',
            'status' => 1,
            'billable' => 0,
        ],
    ];

    $this->singleAllocation = [
        'task_id' => 1,
        'project_id' => 100,
        'people_id' => 10,
        'people_ids' => [10],
        'start_date' => '2025-01-01',
        'end_date' => '2025-01-05',
        'hours' => 8.0,
        'name' => 'Development work',
        'status' => 1,
        'billable' => 1,
    ];

    $this->mockClient = new MockClient([
        GetAllocations::class => MockResponse::make(body: $this->allocations),
        GetAllocation::class => MockResponse::make(body: $this->singleAllocation),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all allocations', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetAllocations);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(2);

    $firstAllocation = $response->json()[0];

    expect($firstAllocation)
        ->toHaveKeys(['task_id', 'project_id', 'people_id', 'start_date', 'end_date']);
});

it('can fetch all allocations via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->allocations()->all();

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(2);
});

it('can fetch a single allocation', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetAllocation(1));

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['task_id', 'project_id', 'people_id']);

    expect($response->json()['task_id'])->toBe(1);
});

it('can fetch a single allocation via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->allocations()->get(1);

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['task_id', 'project_id', 'people_id']);
});
