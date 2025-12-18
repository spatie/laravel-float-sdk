<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetClient;
use Spatie\FloatSdk\Requests\GetClients;

beforeEach(function () {
    $this->clients = [
        ['client_id' => 100, 'name' => 'Acme Corp'],
        ['client_id' => 101, 'name' => 'Globex Inc'],
        ['client_id' => 102, 'name' => 'Initech'],
    ];

    $this->singleClient = ['client_id' => 100, 'name' => 'Acme Corp'];

    $this->mockClient = new MockClient([
        GetClients::class => MockResponse::make(body: $this->clients),
        GetClient::class => MockResponse::make(body: $this->singleClient),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user-agent');
});

it('can fetch all clients', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetClients);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(3);

    $firstClient = $response->json()[0];

    expect($firstClient)
        ->toHaveKeys(['client_id', 'name']);
});

it('can fetch all clients via resource', function () {
    $paginator = $this->client
        ->withMockClient($this->mockClient)
        ->clients()->all();

    expect($paginator)->toBeInstanceOf(\Saloon\PaginationPlugin\Paginator::class);
});

it('can fetch a single client', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetClient(100));

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['client_id', 'name']);

    expect($response->json()['client_id'])->toBe(100);
});

it('can fetch a single client via resource', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->clients()->get(100);

    expect($response->json())
        ->toBeArray()
        ->toHaveKeys(['client_id', 'name']);
});
