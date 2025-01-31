<?php

namespace Spatie\FloatSdk;

use GuzzleHttp\Client;

class FloatClient
{
    protected Client $client;

    public function __construct(
        private readonly string $apiKey,
        private readonly string $baseUri,
    ) {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }
}
