<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Kiosk;
use App\Models\KioskParticipant;
use App\Models\User;
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
            'user_id' => User::factory(),
            'kiosk_id' => Kiosk::inRandomOrder()->pluck('id')->first(),
            'bank_id' => Bank::inRandomOrder()->pluck('id')->first(),
            'account_no' => $this->faker->bankAccountNumber(),
        ];
    }
}
