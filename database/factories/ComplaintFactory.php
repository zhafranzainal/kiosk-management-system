<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Support\Str;
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
            'description' => $this->faker->sentence(15),
            'status' => 'Pending',
            'kiosk_participant_id' => \App\Models\KioskParticipant::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
