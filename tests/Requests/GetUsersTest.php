<?php

namespace Spatie\FloatSdk\Tests\Requests;

use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetUsers;

it('can fetch all the users of an organisation', function () {
    $client = app(FloatClient::class);

    $response = $client->send(new GetUsers);

    expect($response->json())->toBeArray();

    $firstUser = $response->json()[0];

    expect($firstUser)
        ->toHaveKeys(['people_id', 'name', 'email', 'job_title', 'active']);
});
