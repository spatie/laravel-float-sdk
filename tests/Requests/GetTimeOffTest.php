<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetTimeoffs;
use Spatie\FloatSdk\Requests\GetTimeOffTypes;

beforeEach(function () {
    $this->timeoffs = [
        [
            'start_date' => '2025-01-01',
            'end_date' => '2025-01-05',
            'timeoff_type_name' => 'Vacation',
            'full_day' => 1,
            'people_ids' => [10, 11],
            'timeoff_type_id' => '1',
            'repeat_state' => null,
            'repeat_end' => null,
        ],
        [
            'start_date' => '2025-02-10',
            'end_date' => '2025-02-10',
            'timeoff_type_name' => 'Sick Leave',
            'full_day' => 1,
            'people_ids' => [12],
            'timeoff_type_id' => '2',
            'repeat_state' => null,
            'repeat_end' => null,
        ],
    ];

    $this->timeoffTypes = [
        ['timeoff_type_id' => 1, 'timeoff_type_name' => 'Vacation'],
        ['timeoff_type_id' => 2, 'timeoff_type_name' => 'Sick Leave'],
        ['timeoff_type_id' => 3, 'timeoff_type_name' => 'Personal Day'],
    ];

    $this->mockClient = new MockClient([
        GetTimeoffs::class => MockResponse::make(body: $this->timeoffs),
        GetTimeOffTypes::class => MockResponse::make(body: $this->timeoffTypes),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all timeoffs', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetTimeoffs('2025-01-01', '2025-12-31'));

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(2);

    $firstTimeoff = $response->json()[0];

    expect($firstTimeoff)
        ->toHaveKeys(['start_date', 'end_date', 'timeoff_type_name', 'people_ids']);
});

it('can fetch all timeoffs via resource', function () {
    $paginator = $this->client
        ->withMockClient($this->mockClient)
        ->timeOff()->all('2025-01-01', '2025-12-31');

    expect($paginator)->toBeInstanceOf(\Saloon\PaginationPlugin\Paginator::class);
});

it('can fetch timeoff types', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetTimeOffTypes);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);

    $firstType = $response->json()[0];

    expect($firstType)
        ->toHaveKeys(['timeoff_type_id', 'timeoff_type_name']);
});

it('can fetch timeoff types via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->timeOff()->types();

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);
});
