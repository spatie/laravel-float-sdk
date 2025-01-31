<?php

namespace Spatie\FloatSdk;

use GuzzleHttp\Client;

class FloatClient
{
    protected Client $client;

    public function __construct(private string $apiKey)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.float.com/v3',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }
}
