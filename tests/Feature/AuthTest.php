<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        User::create([
            'name' => 'Test User',
            'email' => 'a@gmail.com',
            'password' => Hash::make('12345')
        ]);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'a@gmail.com',
            'password' => '12345'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $response = $this->post('/login', [
            'email' => 'a@gmail.com',
            'password' => 'wrong_password'
        ]);

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_email_that_does_not_exist()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@gmail.com',
            'password' => '12345'
        ]);

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_empty_fields()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => ''
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }
}