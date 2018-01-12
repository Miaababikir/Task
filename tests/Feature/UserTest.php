<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = User::create([
        'name' => 'Mosab',
        'email' => 'admin@admin.com',
        'password' => bcrypt('123456'),
        'verifyToken' => Str::random(20),
        'status' => '0',
        ]);

        $this->assertEquals("Mosab", $user->name);
    }
}
