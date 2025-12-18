<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetPublicHolidays;

beforeEach(function () {
    $this->publicHolidays = [
        ['id' => 1, 'name' => 'New Year', 'dates' => ['2025-01-01']],
        ['id' => 2, 'name' => 'Christmas', 'dates' => ['2025-12-25', '2025-12-26']],
        ['id' => 3, 'name' => 'Easter', 'dates' => ['2025-04-20', '2025-04-21']],
    ];

    $this->mockClient = new MockClient([
        GetPublicHolidays::class => MockResponse::make(body: $this->publicHolidays),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all public holidays', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetPublicHolidays(2025));

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);

    $firstHoliday = $response->json()[0];

    expect($firstHoliday)
        ->toHaveKeys(['id', 'name', 'dates']);
});

it('can fetch all public holidays via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->publicHolidays()->all(2025);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);
});
