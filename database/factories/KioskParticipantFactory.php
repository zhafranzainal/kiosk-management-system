<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\KioskParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

class KioskParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KioskParticipant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_no' => $this->faker->text(255),
            'kiosk_id' => \App\Models\Kiosk::factory(),
            'bank_id' => \App\Models\Bank::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
