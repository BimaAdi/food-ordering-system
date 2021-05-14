<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test Login API
     *
     * @return void
     */
    public function test_login()
    {
        $role = Role::factory()->create([
            'name' => 'admin'
        ]);

        $user = User::factory()->create([
            'name' => 'TestGuy',
            'email' => 'testguy@local',
            'password' => Hash::make('test123'),
            'role_id' => $role->id
        ]);
        
        // User login 
        // with correct credentials
        // should return status 200, user data, role and token
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'test123',
        ]);    

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => 
                $json->whereAllType([
                    'id' => 'integer',
                    'name' => 'string',
                    'email' => 'string',
                    'role' => 'string',
                    'token' => 'string'
                ])
        );

        // User login 
        // with incorrect credentials
        // should return status 400 Invalid login details
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'falsepassword',
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid login details'
            ]);
    }

    public function test_logout()
    {
        // not login user logout should return Unauthenticated
        $response = $this->postJson('/api/logout');
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);

        // login user logout should return you are logout
        $role = Role::factory()->create([
            'name' => 'admin'
        ]);
        
        Sanctum::actingAs(
            User::factory()->create([
                'name' => 'TestGuy',
                'email' => 'testguy@local',
                'password' => Hash::make('test123'),
                'role_id' => $role->id
            ]),
            ['auth_token']
        );

        $response = $this->postJson('/api/logout');

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'you are logged out'
            ]);
    }
}
