<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName(),
            // Ensure the password is unique by appending the username to make it unique
            'password' => Hash::make($this->faker->password().uniqid()), // Adding unique ID to password for uniqueness
        ];
    }
}
