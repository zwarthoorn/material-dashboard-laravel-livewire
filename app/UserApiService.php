<?php

namespace App;

class UserApiService extends BaseApiService
{
    protected function getEndpoint(): string
    {
        return '/users';
    }

    public function getUserById(int $id): array
    {
        return $this->get("/$id")->json();
    }

    public function createUser(array $userData): array
    {
        return $this->post('', $userData)->json();
    }
}
