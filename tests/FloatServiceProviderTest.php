<?php

namespace Spatie\FloatSdk\Tests;

use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\FloatServiceProvider;

beforeEach(function () {
    $this->provider = new FloatServiceProvider($this->app);
});

it('registers the Client in the container', function () {
    config()->set('float-sdk', [
        'api_token' => 'fake-token',
        'user_agent' => 'fake-user-agent',
    ]);

    $this->provider->register();

    $client = app(FloatClient::class);

    expect($client)->toBeInstanceOf(FloatClient::class);
});

it('throws an exception if api_token is missing', function () {
    config()->set('float-sdk', [
        'api_token' => null,
        'user_agent' => 'fake-user-agent',
    ]);

    $this->provider->register();

    app(FloatClient::class);
})->throws('No Float API token was provided. Make sure to set the `FLOAT_API_TOKEN` environment variable.');

it('throws an exception when no user_agent is set', function () {
    config()->set('float-sdk', [
        'api_token' => 'fake-token',
        'user_agent' => null,
    ]);

    $this->provider->register();

    app(FloatClient::class);
})->throws('Float requires a User-Agent header in the format: `YourAppName (your-email@example.com)`. Please set the `FLOAT_USER_AGENT` environment variable accordingly.');
