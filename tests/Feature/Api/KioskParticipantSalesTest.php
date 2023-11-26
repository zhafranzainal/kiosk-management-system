<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sale;
use App\Models\KioskParticipant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KioskParticipantSalesTest extends TestCase
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
    public function it_gets_kiosk_participant_sales()
    {
        $kioskParticipant = KioskParticipant::factory()->create();
        $sales = Sale::factory()
            ->count(2)
            ->create([
                'kiosk_participant_id' => $kioskParticipant->id,
            ]);

        $response = $this->getJson(
            route('api.kiosk-participants.sales.index', $kioskParticipant)
        );

        $response->assertOk()->assertSee($sales[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_kiosk_participant_sales()
    {
        $kioskParticipant = KioskParticipant::factory()->create();
        $data = Sale::factory()
            ->make([
                'kiosk_participant_id' => $kioskParticipant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.kiosk-participants.sales.store', $kioskParticipant),
            $data
        );

        $this->assertDatabaseHas('sales', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $sale = Sale::latest('id')->first();

        $this->assertEquals($kioskParticipant->id, $sale->kiosk_participant_id);
    }
}
