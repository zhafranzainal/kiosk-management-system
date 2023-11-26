<?php

namespace Database\Factories;

use App\Models\KioskParticipant;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kiosk_participant_id' => KioskParticipant::inRandomOrder()->pluck('id')->first(),
            'amount' => $this->faker->randomFloat(2, 500, 10000),
        ];
    }
}
