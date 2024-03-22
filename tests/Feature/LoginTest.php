<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase; DO NOT USE THIS IT WILL ELIMINATE THE DATABASE CONTENTS
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        // Fetch the user directly from the database
        // Ensure you have a user with these credentials in your test database
        $user = Employee::where('Employee_ID', 'test_user')->first();
    
        $response = $this->post('/login', [
            'Employee_ID' => 'test_user',
            'password' => 'test_password', // Make sure this is the correct password for the test_user
        ]);
    
        $response->assertRedirect('/dashboard'); // Assuming the user is redirected to '/dashboard' upon successful login
        $this->assertAuthenticatedAs($user);
    }
    

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $response = $this->post('/login', [
            'Employee_ID' => 'wrong_user',
            'password' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors(); // This checks if the session has errors, which should be the case if login fails
        $this->assertGuest(); // This asserts that no user is authenticated
    }
}
