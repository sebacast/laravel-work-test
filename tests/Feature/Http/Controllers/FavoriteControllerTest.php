<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_index_favorite_empty()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get('favorites')
            ->assertStatus(200)
            ->assertSee('No favorites found');
    }

    public function test_index_favorite_with_data()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get('favorites')
            ->assertStatus(200)
            ->assertSee($favorite->id)
            ->assertSee($favorite->name);
    }

    public function test_show_favorite()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get("favorites/$favorite->id")
            ->assertStatus(200);
    }

    public function test_show_favorite_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        //user intenta entrar a la vista show del favorite de user2
        $this
            ->actingAs($user)
            ->get("favorites/$favorite->id")
            ->assertStatus(403);
    }

    public function test_create_favorite()
    {
        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->get("favorites/create")
            ->assertStatus(200);
    }

    public function test_store_favorites()
    {
        $user = User::factory()->create();
        //el formulario es una serie de array inputs, que el controlador recibe y valida
        //entonces tenemos a name[] y url[]
        //luego los indices de cada array indican el numero de registro
        $name = [$this->faker->sentence(2), $this->faker->sentence(2), $this->faker->sentence(2)];
        $url =  [$this->faker->url, $this->faker->url, $this->faker->url];
        //descomentar si permite asignar favoritos entre usuarios
        //$user2 = User::factory()->create();
        //$user3 = User::factory()->create();
        //$users = [$user->id, $user2->id, $user3->id];

        $data = [
            'name' => $name,
            'url' => $url,
            //'user' => $users;
        ];

        $this
            ->actingAs($user)
            ->post('favorites', $data)
            ->assertRedirect('favorites');

        //$this->assertDatabaseHas('favorites', $data);
    }

    public function test_edit_favorite()
    {
        $user = User::factory()->create(); //id 1
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get("favorites/$favorite->id/edit")
            ->assertStatus(200)
            ->assertSee($favorite->name)
            ->assertSee($favorite->url);
    }

    public function test_edit_favorite_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        //user intenta entrar a la vista edicion del favorite de user2
        $this
            ->actingAs($user)
            ->get("favorites/$favorite->id/edit")
            ->assertStatus(403);
    }

    public function test_update_favorite()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);
        $data = [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url,
        ];

        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id", $data)
            ->assertRedirect("favorites/$favorite->id/edit");

        $this->assertDatabaseHas('favorites', $data);
    }

    public function test_update_favorite_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        $data = [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url,
        ];
        //user intenta actualizar el favorite de user2
        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id", $data)
            ->assertStatus(403);
    }

    public function test_update_favorite_name()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);
        $data = [
            'id' => $favorite->id,
            'name' => $this->faker->sentence(2),
        ];

        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id/name", $data)
            ->assertRedirect("favorites/$favorite->id");

        $this->assertDatabaseHas('favorites', $data);
    }
    public function test_update_favorite_name_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        $data = [
            'name' => $this->faker->sentence(2),
        ];
        //user intenta actualizar el favorite de user2
        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id/name", $data)
            ->assertStatus(403);
    }

    public function test_update_favorite_url()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);
        $data = [
            'id' => $favorite->id,
            'url' => $this->faker->url,
        ];

        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id/url", $data)
            ->assertRedirect("favorites/$favorite->id");

        $this->assertDatabaseHas('favorites', $data);
    }

    public function test_update_favorite_url_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        $data = [
            'url' => $this->faker->url,
        ];
        //user intenta actualizar el favorite de user2
        $this
            ->actingAs($user)
            ->put("favorites/$favorite->id/url", $data)
            ->assertStatus(403);
    }


    public function test_destroy_favorite()
    {
        $user = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->delete("favorites/$favorite->id")
            ->assertRedirect('favorites');

        $this->assertSoftDeleted('favorites', [
            'id' => $favorite->id,
            'url' => $favorite->url,
        ]);
    }

    public function test_destroy_favorite_policy()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $favorite = Favorite::factory()->create(['user_id' => $user2->id]);
        $this
            ->actingAs($user) //user intenta elimitar el favorito de user2
            ->delete("favorites/$favorite->id")
            ->assertStatus(403);
    }
}
