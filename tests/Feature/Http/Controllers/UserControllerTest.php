<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_index_user()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get('users')
            ->assertStatus(200)
            ->assertSee($user->id)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->birthday);
    }

    public function test_show_user()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get("users/$user->id")
            ->assertStatus(200);
    }

    public function test_create_users()
    {
        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->get("users/create")
            ->assertStatus(200);
    }

    public function test_store_users()
    {
        $user = User::factory()->create();
        //el formulario es una serie de array inputs, que el controlador recibe y valida
        //luego los indices de cada array indican el numero de registro
        $name = [$this->faker->sentence(2), $this->faker->sentence(2), $this->faker->sentence(2)];
        $birthday =  [$this->faker->date('Y-m-d'), $this->faker->date('Y-m-d'), $this->faker->date('Y-m-d')];
        $email = [$this->faker->unique()->safeEmail, $this->faker->unique()->safeEmail, $this->faker->unique()->safeEmail];
        $password = ['aaaaaaaaa', 'bbbbbbbbb', '123456789'];
        $password_confirmation = ['aaaaaaaaa', 'bbbbbbbbb', '123456789'];

        $data = [
            'name' => $name,
            'birthday' => $birthday,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ];
        $checkData = [
            'name' => $name,
            'birthday' => $birthday,
            'email' => $email,
        ];

        $this
            ->actingAs($user)
            ->post('users', $data)
            ->assertRedirect('users');

        $this->assertDatabaseHas('users', $checkData);
    }


    public function test_edit_user()
    {
        $user = User::factory()->create(); //id 1
        $user2 = User::factory()->create(); //id 2

        $this
            ->actingAs($user)
            ->get("users/$user2->id/edit")
            ->assertStatus(200)
            ->assertSee($user->id)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->birthday);
    }

    public function test_update_user()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $data = [
            'name' => 'prueba',
            'birthday' => '1990-01-01',
            'email' => 'prueba@prueba.com',
            'password' => '987654321',
        ];

        $this
            ->actingAs($user)
            ->put("users/$testUser->id", $data)
            ->assertRedirect("users/$testUser->id/edit");
        $data = [
            'id' => $testUser->id,
            'name' => 'prueba',
            'birthday' => '1990-01-01',
            'email' => 'prueba@prueba.com',
        ];

        $this->assertDatabaseHas('users', $data);
    }


    public function test_update_user_name()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $data = [
            'id' => $testUser->id,
            'name' => 'prueba',
        ];

        $this
            ->actingAs($user)
            ->put("users/$testUser->id/name", $data)
            ->assertRedirect("users/$testUser->id");

        $this->assertDatabaseHas('users', $data);
    }

    public function test_update_user_birthday()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $data = [
            'id' => $testUser->id,
            'birthday' => '2005-07-07 00:00:00',
        ];
        $this
            ->actingAs($user)
            ->put("users/$testUser->id/birthday", $data)
            ->assertRedirect("users/$testUser->id");
        $this->assertDatabaseHas('users', $data);
    }

    public function test_update_user_email()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $data = [
            'id' => $testUser->id,
            'email' => 'email@email.com',
        ];

        $this
            ->actingAs($user)
            ->put("users/$testUser->id/email", $data)
            ->assertRedirect("users/$testUser->id");

        $this->assertDatabaseHas('users', $data);
    }

    public function test_update_user_password()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $data = [
            'password' => '1234567898',
        ];

        $this
            ->actingAs($user)
            ->put("users/$testUser->id/password", $data)
            ->assertRedirect("users/$testUser->id");

        //$this->assertDatabaseHas('users', $data);
    }

    public function test_destroy_user()
    {
        $user = User::factory()->create();
        $testUser = User::factory()->create();

        $this
            ->actingAs($user)
            ->delete("users/$testUser->id")
            ->assertRedirect('users');

        $this->assertSoftDeleted('users', [
            'id' => $testUser->id,
            'name' => $testUser->name,
        ]);
    }
}
