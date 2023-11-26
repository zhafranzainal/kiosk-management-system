<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Kiosk;

use App\Models\BusinessType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KioskTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_kiosks_list()
    {
        $kiosks = Kiosk::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.kiosks.index'));

        $response->assertOk()->assertSee($kiosks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_kiosk()
    {
        $data = Kiosk::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.kiosks.store'), $data);

        $this->assertDatabaseHas('kiosks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_kiosk()
    {
        $kiosk = Kiosk::factory()->create();

        $businessType = BusinessType::factory()->create();

        $data = [
            'business_type_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'location' => $this->faker->text(255),
            'suggested_action' => 'No Action',
            'comment' => $this->faker->text(),
            'status' => 'Inactive',
            'business_type_id' => $businessType->id,
        ];

        $response = $this->putJson(route('api.kiosks.update', $kiosk), $data);

        $data['id'] = $kiosk->id;

        $this->assertDatabaseHas('kiosks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_kiosk()
    {
        $kiosk = Kiosk::factory()->create();

        $response = $this->deleteJson(route('api.kiosks.destroy', $kiosk));

        $this->assertSoftDeleted($kiosk);

        $response->assertNoContent();
    }
}
