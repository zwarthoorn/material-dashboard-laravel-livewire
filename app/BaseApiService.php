<?php

namespace App;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class BaseApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.backend.url').'/api';
    }

    abstract protected function getEndpoint(): string;

    protected function makeRequest(string $method, string $path = '', array $options = []): Response
    {
        $url = $this->baseUrl . $this->getEndpoint() . $path;
        return Http::withToken(request()->cookie('api_token'))->$method($url, $options);
    }

    public function get(string $path = '', array $query = []): Response
    {
        return $this->makeRequest('get', $path, $query);
    }

    public function post(string $path = '', array $data = []): Response
    {
        return $this->makeRequest('post', $path, $data);
    }

}
