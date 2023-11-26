<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Kiosk;
use App\Models\BusinessType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTypeKiosksTest extends TestCase
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
    public function it_gets_business_type_kiosks()
    {
        $businessType = BusinessType::factory()->create();
        $kiosks = Kiosk::factory()
            ->count(2)
            ->create([
                'business_type_id' => $businessType->id,
            ]);

        $response = $this->getJson(
            route('api.business-types.kiosks.index', $businessType)
        );

        $response->assertOk()->assertSee($kiosks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_business_type_kiosks()
    {
        $businessType = BusinessType::factory()->create();
        $data = Kiosk::factory()
            ->make([
                'business_type_id' => $businessType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.business-types.kiosks.store', $businessType),
            $data
        );

        $this->assertDatabaseHas('kiosks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $kiosk = Kiosk::latest('id')->first();

        $this->assertEquals($businessType->id, $kiosk->business_type_id);
    }
}
