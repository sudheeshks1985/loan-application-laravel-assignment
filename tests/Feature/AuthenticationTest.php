<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                
                "error" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testRepeatPassword()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345"
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                
                "error" => [
                    "password" => ["The password confirmation does not match."]
                ]
            ]);
    }


    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(200)
            ->assertJson([
                
                "error" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }


    
}
