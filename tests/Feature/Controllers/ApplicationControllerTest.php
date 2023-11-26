<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Application;

use App\Models\Kiosk;
use App\Models\Transaction;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationControllerTest extends TestCase
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
    public function it_displays_index_view_with_applications()
    {
        $applications = Application::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('applications.index'));

        $response
            ->assertOk()
            ->assertViewIs('applications.index')
            ->assertViewHas('applications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_application()
    {
        $response = $this->get(route('applications.create'));

        $response->assertOk()->assertViewIs('applications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_application()
    {
        $data = Application::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('applications.store'), $data);

        $this->assertDatabaseHas('applications', $data);

        $application = Application::latest('id')->first();

        $response->assertRedirect(route('applications.edit', $application));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_application()
    {
        $application = Application::factory()->create();

        $response = $this->get(route('applications.show', $application));

        $response
            ->assertOk()
            ->assertViewIs('applications.show')
            ->assertViewHas('application');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_application()
    {
        $application = Application::factory()->create();

        $response = $this->get(route('applications.edit', $application));

        $response
            ->assertOk()
            ->assertViewIs('applications.edit')
            ->assertViewHas('application');
    }

    /**
     * @test
     */
    public function it_updates_the_application()
    {
        $application = Application::factory()->create();

        $user = User::factory()->create();
        $kiosk = Kiosk::factory()->create();
        $transaction = Transaction::factory()->create();

        $data = [
            'transaction_id' => $this->faker->randomNumber(),
            'kiosk_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => 'Pending',
            'user_id' => $user->id,
            'kiosk_id' => $kiosk->id,
            'transaction_id' => $transaction->id,
        ];

        $response = $this->put(
            route('applications.update', $application),
            $data
        );

        $data['id'] = $application->id;

        $this->assertDatabaseHas('applications', $data);

        $response->assertRedirect(route('applications.edit', $application));
    }

    /**
     * @test
     */
    public function it_deletes_the_application()
    {
        $application = Application::factory()->create();

        $response = $this->delete(route('applications.destroy', $application));

        $response->assertRedirect(route('applications.index'));

        $this->assertSoftDeleted($application);
    }
}
