<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bank;
use App\Models\KioskParticipant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankKioskParticipantsTest extends TestCase
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
    public function it_gets_bank_kiosk_participants()
    {
        $bank = Bank::factory()->create();
        $kioskParticipants = KioskParticipant::factory()
            ->count(2)
            ->create([
                'bank_id' => $bank->id,
            ]);

        $response = $this->getJson(
            route('api.banks.kiosk-participants.index', $bank)
        );

        $response->assertOk()->assertSee($kioskParticipants[0]->account_no);
    }

    /**
     * @test
     */
    public function it_stores_the_bank_kiosk_participants()
    {
        $bank = Bank::factory()->create();
        $data = KioskParticipant::factory()
            ->make([
                'bank_id' => $bank->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.banks.kiosk-participants.store', $bank),
            $data
        );

        $this->assertDatabaseHas('kiosk_participants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $kioskParticipant = KioskParticipant::latest('id')->first();

        $this->assertEquals($bank->id, $kioskParticipant->bank_id);
    }
}
