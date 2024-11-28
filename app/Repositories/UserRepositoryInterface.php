<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByPassword(string $password): ?User;

    public function createUser(array $data): User;
}
