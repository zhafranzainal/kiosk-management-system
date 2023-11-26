<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sale;

use App\Models\KioskParticipant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleTest extends TestCase
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
    public function it_gets_sales_list()
    {
        $sales = Sale::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales.index'));

        $response->assertOk()->assertSee($sales[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sale()
    {
        $data = Sale::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sales.store'), $data);

        $this->assertDatabaseHas('sales', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sale()
    {
        $sale = Sale::factory()->create();

        $kioskParticipant = KioskParticipant::factory()->create();

        $data = [
            'kiosk_participant_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomNumber(2),
            'kiosk_participant_id' => $kioskParticipant->id,
        ];

        $response = $this->putJson(route('api.sales.update', $sale), $data);

        $data['id'] = $sale->id;

        $this->assertDatabaseHas('sales', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->deleteJson(route('api.sales.destroy', $sale));

        $this->assertSoftDeleted($sale);

        $response->assertNoContent();
    }
}
