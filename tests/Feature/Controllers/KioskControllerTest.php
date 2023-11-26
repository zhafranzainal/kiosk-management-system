<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Kiosk;

use App\Models\BusinessType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KioskControllerTest extends TestCase
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
    public function it_displays_index_view_with_kiosks()
    {
        $kiosks = Kiosk::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('kiosks.index'));

        $response
            ->assertOk()
            ->assertViewIs('kiosks.index')
            ->assertViewHas('kiosks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_kiosk()
    {
        $response = $this->get(route('kiosks.create'));

        $response->assertOk()->assertViewIs('kiosks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_kiosk()
    {
        $data = Kiosk::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('kiosks.store'), $data);

        $this->assertDatabaseHas('kiosks', $data);

        $kiosk = Kiosk::latest('id')->first();

        $response->assertRedirect(route('kiosks.edit', $kiosk));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_kiosk()
    {
        $kiosk = Kiosk::factory()->create();

        $response = $this->get(route('kiosks.show', $kiosk));

        $response
            ->assertOk()
            ->assertViewIs('kiosks.show')
            ->assertViewHas('kiosk');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_kiosk()
    {
        $kiosk = Kiosk::factory()->create();

        $response = $this->get(route('kiosks.edit', $kiosk));

        $response
            ->assertOk()
            ->assertViewIs('kiosks.edit')
            ->assertViewHas('kiosk');
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

        $response = $this->put(route('kiosks.update', $kiosk), $data);

        $data['id'] = $kiosk->id;

        $this->assertDatabaseHas('kiosks', $data);

        $response->assertRedirect(route('kiosks.edit', $kiosk));
    }

    /**
     * @test
     */
    public function it_deletes_the_kiosk()
    {
        $kiosk = Kiosk::factory()->create();

        $response = $this->delete(route('kiosks.destroy', $kiosk));

        $response->assertRedirect(route('kiosks.index'));

        $this->assertSoftDeleted($kiosk);
    }
}
