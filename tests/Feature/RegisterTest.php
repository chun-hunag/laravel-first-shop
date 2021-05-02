<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations; // 有使用資料庫的測試，不use 此 Trait會導致錯誤
    use RefreshDatabase;

    /**
     * A basic feature test for register.
     *
     * @return void
     */
    public function testRegisterView()
    {
        $response = $this->get('/register');
        $response->assertViewIs('auth.register');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test for register action.
     *
     * @return void
     */
    public function testRegisterAction()
    {
        $response = $this->post(route('register', [
            'first_name' => '吳',
            'last_name' => '棋祥',
            'email' => '12345@gmail.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
            'cellphone' => '0988924578'
        ]));
        $response->assertRedirect(route('index'));
        $this->assertDatabaseHas('users', [
            'email' => '12345@gmail.com'
        ]);

    }
}
