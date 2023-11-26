<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KioskParticipant;

class KioskParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kioskParticipants = KioskParticipant::factory()->count(5)->create();
    }
}
