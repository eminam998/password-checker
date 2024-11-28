<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findByPassword(string $password): ?User
    {
        return User::all()->first(function ($user) use ($password) {
            return Hash::check($password, $user->password);
        });
    }

    public function createUser(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
