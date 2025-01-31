<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetUsers;

beforeEach(function () {
    $people = [
        ['id' => 00000001, 'name' => 'Wouter', 'email' => 'wouter@spatie.com', 'job_title' => 'Project manager', 'active' => 0],
        ['id' => 00000002, 'name' => 'Séba', 'email' => 'sebastien@spatie.com', 'job_title' => 'Frontend developer', 'active' => 1],
        ['id' => 00000003, 'name' => 'Jimi', 'email' => 'jimi@spatie.com', 'job_title' => 'Digital designer', 'active' => 1],
        ['id' => 00000004, 'name' => 'Tim', 'email' => 'tim@spatie.com', 'job_title' => 'Backend developer', 'active' => 1],
        ['id' => 00000005, 'name' => 'Niels', 'email' => 'niels@spatie.com', 'job_title' => 'Backend developer', 'active' => 1],
        ['id' => 00000006, 'name' => 'Willem', 'email' => 'willem@spatie.com', 'job_title' => 'Frontend developer', 'active' => 0],
        ['id' => 00000007, 'name' => 'Sebastian', 'email' => 'sebastian@spatie.com', 'job_title' => 'Frontend developer', 'active' => 1],
        ['id' => 00000010, 'name' => 'Ruben', 'email' => 'ruben@spatie.com', 'job_title' => 'Backend developer', 'active' => 1],
        ['id' => 00000011, 'name' => 'Rias', 'email' => 'rias@spatie.com', 'job_title' => 'Backend developer', 'active' => 1],
        ['id' => 00000012, 'name' => 'Freek', 'email' => 'freek@spatie.com', 'job_title' => 'Backend developer', 'active' => 1],
        ['id' => 00000013, 'name' => 'Alex', 'email' => 'alex@spatie.com', 'job_title' => 'Backend developer', 'active' => 0],
    ];

    $this->mockClient = new MockClient([
        GetUsers::class => MockResponse::make(body: $people),
    ]);

    $this->client = new FloatClient('fake-api-key', 'fake-user_agent');
});

it('can fetch all the users of an organisation', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->send(new GetUsers);

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(11);

    $firstUser = $response->json()[0];

    expect($firstUser)
        ->toHaveKeys(['id', 'name', 'email', 'job_title', 'active']);
});

it('can fetch the users with a specific method', function () {
    $response = $this->client
        ->withMockClient($this->mockClient)
        ->users()->all();

    expect($response->json())
        ->toBeArray()
        ->toHaveCount(11);

    $firstUser = $response->json()[0];

    expect($firstUser)
        ->toHaveKeys(['id', 'name', 'email', 'job_title', 'active']);
});
