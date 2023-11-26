<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BusinessType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_business_types()
    {
        $businessTypes = BusinessType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('business-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('business_types.index')
            ->assertViewHas('businessTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_business_type()
    {
        $response = $this->get(route('business-types.create'));

        $response->assertOk()->assertViewIs('business_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_business_type()
    {
        $data = BusinessType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('business-types.store'), $data);

        $this->assertDatabaseHas('business_types', $data);

        $businessType = BusinessType::latest('id')->first();

        $response->assertRedirect(route('business-types.edit', $businessType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_business_type()
    {
        $businessType = BusinessType::factory()->create();

        $response = $this->get(route('business-types.show', $businessType));

        $response
            ->assertOk()
            ->assertViewIs('business_types.show')
            ->assertViewHas('businessType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_business_type()
    {
        $businessType = BusinessType::factory()->create();

        $response = $this->get(route('business-types.edit', $businessType));

        $response
            ->assertOk()
            ->assertViewIs('business_types.edit')
            ->assertViewHas('businessType');
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

        $response = $this->put(
            route('business-types.update', $businessType),
            $data
        );

        $data['id'] = $businessType->id;

        $this->assertDatabaseHas('business_types', $data);

        $response->assertRedirect(route('business-types.edit', $businessType));
    }

    /**
     * @test
     */
    public function it_deletes_the_business_type()
    {
        $businessType = BusinessType::factory()->create();

        $response = $this->delete(
            route('business-types.destroy', $businessType)
        );

        $response->assertRedirect(route('business-types.index'));

        $this->assertSoftDeleted($businessType);
    }
}
