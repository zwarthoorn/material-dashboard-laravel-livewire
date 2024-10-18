<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ApiUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        // Fetch user from API
        $response = Http::get(config('services.backend.url')."/api/user/{$identifier}");

        if ($response->successful()) {
            return new User($response->json());
        }

        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        $response = Http::withToken($token)->get(config('services.backend.url')."/api/user");

        if ($response->successful()) {
            return new User($response->json());
        }

        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not implemented for API authentication
    }

    public function retrieveByCredentials(array $credentials)
    {
        // This method is called during the login process
        // We'll use it to validate credentials against the API
        $response = Http::post(config('services.backend.url')."/api/login", $credentials);

        if ($response->successful()) {
            $data = $response->json();
            return new User($data['user']);
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Credentials are validated in retrieveByCredentials, so we'll always return true here
        return true;
    }
}
