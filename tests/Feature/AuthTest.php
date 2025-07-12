<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
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

    // Password Reset Tests

    /** @test */
    public function user_can_request_password_reset_link()
    {
        Mail::fake();

        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test12@example.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/password/email', [
            'email' => 'test12@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'We have emailed your password reset link!');
        
        Mail::assertQueued(PasswordResetMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        $this->assertDatabaseHas('users', [
            'email' => 'test12@example.com',
        ]);
        
        // Verify that password_reset_token was set
        $user = User::where('email', 'test12@example.com')->first();
        $this->assertNotNull($user->password_reset_token);
    }

    /** @test */
    public function user_cannot_request_password_reset_with_nonexistent_email()
    {
        $response = $this->post('/auth/password/email', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_can_view_password_reset_request_form()
    {
        $response = $this->get('/auth/password/reset');

        $response->assertStatus(200);
        $response->assertViewIs('website.auth.passwords.email');
    }

    /** @test */
    public function user_can_view_password_reset_form_with_valid_token()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test@example.com',
            'password' => bcrypt('Greatpassword123'),
            'password_reset_token' => 'valid-token-123',
            'password_reset_token_expires_at' => now()->addHour(),
            'role_id' => $this->role->id,
        ]);

        $response = $this->get('/auth/password/reset/valid-token-123');

        $response->assertStatus(200);
        $response->assertViewIs('website.auth.passwords.reset');
        $response->assertViewHas('token', 'valid-token-123');
    }

    /** @test */
    public function user_can_reset_password_with_valid_token()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test2@example.com',
            'password' => bcrypt('Greatpassword123'),
            'password_reset_token' => 'valid-token-123',
            'password_reset_token_expires_at' => now()->addHour(),
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/password/reset', [
            'email' => 'test2@example.com',
            'token' => 'valid-token-123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('auth.login.index'));
        $response->assertSessionHas('status', 'Your password has been reset!');

        // Verify password was updated
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
        
        // Verify reset token was cleared
        $this->assertNull($user->password_reset_token);
        $this->assertNull($user->password_reset_token_expires_at);
    }

    /** @test */
    public function user_cannot_reset_password_with_invalid_token()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test3@example.com',
            'password' => bcrypt('Greatpassword123'),
            'password_reset_token' => 'valid-token-123',
            'password_reset_token_expires_at' => now()->addHour(),
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/password/reset', [
            'email' => 'test3@example.com',
            'token' => 'invalid-token',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_cannot_reset_password_with_expired_token()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test4@example.com',
            'password' => bcrypt('Greatpassword123'),
            'password_reset_token' => 'expired-token-123',
            'password_reset_token_expires_at' => now()->subHour(), // Expired
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/password/reset', [
            'email' => 'test4@example.com',
            'token' => 'expired-token-123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_cannot_reset_password_with_mismatched_passwords()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test5@example.com',
            'password' => bcrypt('Greatpassword123'),
            'password_reset_token' => 'valid-token-123',
            'password_reset_token_expires_at' => now()->addHour(),
            'role_id' => $this->role->id,
        ]);

        $response = $this->post('/auth/password/reset', [
            'email' => 'test5@example.com',
            'token' => 'valid-token-123',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword123',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    // Logout Tests

    /** @test */
    public function authenticated_user_can_logout_from_current_session()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test5@example.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id,
        ]);

        /** @var User $user */
        $this->actingAs($user);

        $response = $this->post('/auth/logout/current');

        $response->assertRedirect(route('auth.login.index'));
        $response->assertSessionHas('status', 'Successfully logged out from current session');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_can_logout_from_all_sessions()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test8@example.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id,
        ]);

        /** @var User $user */
        $this->actingAs($user);

        $response = $this->post('/auth/logout/all');

        $response->assertRedirect(route('auth.login.index'));
        $response->assertSessionHas('status', 'Successfully logged out from all sessions');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_can_logout_from_other_sessions()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test9@example.com',
            'password' => bcrypt('Greatpassword123'),
            'role_id' => $this->role->id,
        ]);

        /** @var User $user */
        $this->actingAs($user);

        $response = $this->post('/auth/logout/others');

        $response->assertRedirect(route('auth.login.index'));
        $response->assertSessionHas('status', 'Successfully logged out from other sessions');
        $this->assertAuthenticated(); // Should still be authenticated in current session
    }

    /** @test */
    public function guest_cannot_access_logout_routes()
    {
        $response = $this->post('/auth/logout/current');
        $response->assertRedirect();

        $response = $this->post('/auth/logout/all');
        $response->assertRedirect();

        $response = $this->post('/auth/logout/others');
        $response->assertRedirect();
    }

    /** @test */
    public function user_can_login_after_password_reset()
    {
        $user = User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'email',
            'email' => 'test10@example.com',
            'password_reset_token' => 'valid-token-123',
            'password_reset_token_expires_at' => now()->addHour(),
            'role_id' => $this->role->id,
        ]);

        // Reset password
        $this->post('/auth/password/reset', [
            'email' => 'test10@example.com',
            'token' => 'valid-token-123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        // Try to login with new password
        $response = $this->post('/auth/login', [
            'email' => 'test10@example.com',
            'password' => 'newpassword123',
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }
}
