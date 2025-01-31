<?php

namespace Spatie\FloatSdk;

use GuzzleHttp\Client;
use Spatie\FloatSdk\Tests\Fake\FakeFloatClient;
use Spatie\FloatSdk\Tests\Fake\FloatClientFake;

class FloatClient
{
    protected Client $client;

    public function __construct(
        private readonly string $apiKey,
        private readonly string $userAgent,
    ) {
        $this->client = new Client([
            'base_uri' => 'https://api.float.com/v3',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'User-Agent' => $this->userAgent,
            ],
        ]);
    }

    /** @internal for testing purposes only */
    public static function fake(): void
    {
        app()->instance(self::class, new FakeFloatClient());
    }
}
