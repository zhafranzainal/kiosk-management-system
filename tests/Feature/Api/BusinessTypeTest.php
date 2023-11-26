<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BusinessType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTypeTest extends TestCase
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
    public function it_gets_business_types_list()
    {
        $businessTypes = BusinessType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.business-types.index'));

        $response->assertOk()->assertSee($businessTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_business_type()
    {
        $data = BusinessType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.business-types.store'), $data);

        $this->assertDatabaseHas('business_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_business_type()
    {
        $businessType = BusinessType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.business-types.update', $businessType),
            $data
        );

        $data['id'] = $businessType->id;

        $this->assertDatabaseHas('business_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_business_type()
    {
        $businessType = BusinessType::factory()->create();

        $response = $this->deleteJson(
            route('api.business-types.destroy', $businessType)
        );

        $this->assertSoftDeleted($businessType);

        $response->assertNoContent();
    }
}
