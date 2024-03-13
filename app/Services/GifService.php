<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class GifService
{
    public function __construct(private readonly string $key)
    {
    }

    private function getClient(): PendingRequest
    {
        return Http::withOptions([
                'base_uri' => 'https://api.giphy.com/v1/'
            ])
            ->timeout(5)
            ->throw();
    }

    public function search(string $query, int $limit = 20, int $offset = 20)
    {
        $response = $this->getClient()->get('gifs/search', [
            'api_key' => $this->key,
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
        ])->json();
        return $response;
    }
}
