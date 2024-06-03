<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        User::factory()->count(15)->create();

        $response = $this->json('GET', route('users.index'), [
            '_limit' => 10,
            '_page' => 1,
            '_sort' => 'name',
            '_order' => 'asc'
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'updated_at']
                ],
                'links'
            ]);
    }

    public function testStore()
    {
        $data = [
            'name' => $this->faker->name,
            'phones' => [
                ['phone' => $this->faker->phoneNumber]
            ],
            'emails' => [
                ['email' => $this->faker->safeEmail]
            ]
        ];

        $response = $this->json('POST', route('users.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment(['name' => $data['name']]);
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('users.show', $user->id));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'name',
                'phones',
                'emails'
            ]);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $data = [
            'name' => $this->faker->name,
            'phones' => [
                ['phone' => $this->faker->phoneNumber]
            ],
            'emails' => [
                ['email' => $this->faker->safeEmail]
            ]
        ];

        $response = $this->json('PUT', route('users.update', $user->id), $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['name' => $data['name']]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $response = $this->json('DELETE', route('users.destroy', $user->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
