<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_not_login_user()
    {
        $response = $this->get('/');

        $response->assertSee('Login');
        $response->assertSee('Sign In to your account');
    }

    public function test_user_login_success()
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

        $response = $this->actingAs($user)->get('/home');

        $response->assertSee('TestGuy');
    }

    public function test_user_tab_admin_only()
    {
        // only admin has user sidebar item

        // admin test
        $role = Role::factory()->create([
            'name' => 'admin'
        ]);

        $user = User::factory()->create([
            'name' => 'TestGuy',
            'email' => 'testguy@local',
            'password' => Hash::make('test123'),
            'role_id' => $role->id
        ]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertSee('User');
        
        // non admin test
        $role = Role::factory()->create([
            'name' => 'waiter'
        ]);

        $user = User::factory()->create([
            'name' => 'TestGuy',
            'email' => 'testguy@local',
            'password' => Hash::make('test123'),
            'role_id' => $role->id
        ]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertDontSee('User');
    }
}
