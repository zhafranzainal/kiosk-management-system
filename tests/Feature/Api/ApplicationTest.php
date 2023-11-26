<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Application;

use App\Models\Kiosk;
use App\Models\Transaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationTest extends TestCase
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
    public function it_gets_applications_list()
    {
        $applications = Application::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applications.index'));

        $response->assertOk()->assertSee($applications[0]->start_date);
    }

    /**
     * @test
     */
    public function it_stores_the_application()
    {
        $data = Application::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.applications.store'), $data);

        $this->assertDatabaseHas('applications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.applications.update', $application),
            $data
        );

        $data['id'] = $application->id;

        $this->assertDatabaseHas('applications', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_application()
    {
        $application = Application::factory()->create();

        $response = $this->deleteJson(
            route('api.applications.destroy', $application)
        );

        $this->assertSoftDeleted($application);

        $response->assertNoContent();
    }
}
