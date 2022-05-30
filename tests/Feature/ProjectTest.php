<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function getToken()
    {
        $token = auth()->guard('api')->login(User::first());
        $headers['Authorization'] = 'Bearer ' . $token;
        return $headers;
    }

    public function test_register()
    {
        for ($i = 0; $i < 50; $i++) {
            $password = Hash::make(Str::random(8));
            $data = [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => $password,
                'password_confirm' => $password
            ];

            $response = $this->post(route('register'), $data);
            $response->assertStatus(201);
        }
    }

    public function test_createSMS()
    {
        for ($i = 0; $i < 50; $i++) {
            $data = [
                'user_id' => rand(1, 50),
                'message' => $this->faker->text(),
            ];

            $response = $this->post(route('createSMS'), $data, $this->getToken());
            $response->assertStatus(201);
        }
    }

    public function test_getSMSId()
    {
        for ($i = 0; $i < 50; $i++) {
            $response = $this->get(route('getSMSId', rand(1, 50)), $this->getToken());
            $response->assertStatus(200);
        }
    }
}
