<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\KioskParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kiosk_participant_id' => KioskParticipant::inRandomOrder()->pluck('id')->first(),
            'user_id' => KioskParticipant::inRandomOrder()->pluck('id')->first(),
            'description' => $this->faker->sentence(),
            'status' => 'Pending',
        ];
    }
}
