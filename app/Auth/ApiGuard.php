<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use App\Models\User;

class ApiGuard implements Guard
{
    protected $request;
    protected $provider;
    protected $user;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    public function check()
    {
        return ! is_null($this->user());
    }

    public function guest()
    {
        return ! $this->check();
    }

    public function user()
    {
        if (! is_null($this->user)) {
            return $this->user;
        }

        $token = $this->request->cookie('api_token');

        if ($token) {
            $this->user = $this->provider->retrieveByToken(null, $token);
        }

        return $this->user;
    }

    public function id()
    {
        if ($user = $this->user()) {
            return $user->getAuthIdentifier();
        }
    }

    public function validate(array $credentials = [])
    {
        return ! is_null($this->user());
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    // New methods to fully implement the Guard interface

    public function hasUser()
    {
        return ! is_null($this->user);
    }

    public function authenticate()
    {
        if (! is_null($this->user())) {
            return $this->user();
        }

        throw new \Illuminate\Auth\AuthenticationException;
    }

    public function logout()
    {
        $this->user = null;
        $this->request->cookies->remove('api_token');
    }

    public function forgetUser()
    {
        $this->user = null;
    }
}
