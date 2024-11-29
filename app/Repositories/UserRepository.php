<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    public function findByPassword(string $password): ?User
    {
        try {
            return User::all()->first(function ($user) use ($password) {
                return Hash::check($password, $user->password);
            });
        } catch (Exception $e) {
            \Log::error("Error finding user by password: " . $e->getMessage());
            throw new \RuntimeException("Unable to process your request at the moment.");
        }
    }

    public function createUser(array $data): User
    {
        try {
            return User::create([
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
            ]);
        } catch (Exception $e) {
            \Log::error("Error creating user: " . $e->getMessage());
            throw new \RuntimeException("Unable to create user at the moment.");
        }
    }
}
