<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration with valid data.
     *
     * @return void
     */
    public function test_user_can_register_with_valid_data()
    {
        $data = [
            'username' => 'newuser',
            'password' => 'password123',
        ];

        $response = $this->post(route('register'), $data);

        $this->assertDatabaseHas('users', [
            'username' => 'newuser',
        ]);

        $response->assertViewIs('success');

        $response->assertViewHas('username', 'newuser');
    }

    /**
     * Test user registration with existing password.
     *
     * @return void
     */
    public function test_registration_with_existing_password()
    {
        User::create([
            'username' => 'existinguser',
            'password' => bcrypt('password123'),
        ]);

        $data = [
            'username' => 'newuser',
            'password' => 'password123',
        ];

        $response = $this->post(route('register'), $data);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test registration with invalid data (e.g., missing username).
     *
     * @return void
     */
    public function test_registration_with_invalid_data()
    {
        $data = [
            'password' => 'password123',
        ];

        $response = $this->post(route('register'), $data);

        $response->assertSessionHasErrors('username');
    }
}
