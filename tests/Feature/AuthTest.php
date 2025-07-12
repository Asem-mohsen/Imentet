<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $role;
    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::where('name', 'Regular User')->first();
    }

    /** @test */
    public function user_can_register_successfully()
    {
        $response = $this->post('/auth/register', [
            'first_name' => 'Assem',
            'last_name' => 'Mohsen',
            'email' => 'assem@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'Greatpassword123',
            'role_id' => $this->role->id,
        ]);

        $response->assertRedirect(url('/'));
        $this->assertDatabaseHas('users', ['email' => 'assem@gmail.com']);
        $this->assertAuthenticated();
    }

    /** @test */
    public function user_cannot_register_with_invalid_data()
    {
        $response = $this->post('/auth/register', [
            'first_name' => '',
            'last_name' => '',
            'email' => 'not-an-email',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password']);
        $this->assertGuest();
    }


    /** @test */
    public function user_can_login_successfully()
    {
        $user = User::factory()->create([
            'first_name' => 'Assem',
            'last_name' => 'Mohsen',
            'email' => 'assemmohsen@gmail.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id
        ]);

        $response = $this->post('/auth/login', [
            'email' => 'assemmohsen@gmail.com',
            'password' => 'Greatpassword123',
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_wrong_credentials()
    {
        $user = User::factory()->create([
            'first_name' => 'Assem',
            'last_name' => 'Mohsen',
            'email' => 'assemmohsen012@gmail.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/login', [
            'email' => 'assemmohsen012@gmail.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
