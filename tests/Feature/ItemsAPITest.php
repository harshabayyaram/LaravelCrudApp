<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Item;
use App\Models\User;

class ItemsAPITest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_list_all_items()
    {
        Item::factory()->count(3)->create();
        $response = $this->getJson('api/items');
        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_create_item()
    {
        $payload = [
            'name' => 'Test Item',
            'code' => 'ITEM-001',
            'description' => 'Test description',
            'status' => 'active',
        ];

        $response = $this->postJson('/api/items', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'Test Item',
                'code' => 'ITEM-001',
                'status' => 'active',
            ]);

        $this->assertDatabaseHas('items', [
            'code' => 'ITEM-001',
        ]);
    }
    public function test_update_item()
    {
        $item = Item::factory()->create();

        $payload = [
            'name' => 'Updated Name',
            'code' => 'ITEM-001',
            'description' => 'Test description',
            'status' => 'active',
        ];

        $response = $this->putJson("/api/items/{$item->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Updated Name',
                'status' => 'active',
            ]);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'status' => 'active',
        ]);
    }

    public function test_delete_item()
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/api/items/{$item->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}
