<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => 'Pending',
            'user_id' => \App\Models\User::factory(),
            'kiosk_id' => \App\Models\Kiosk::factory(),
            'transaction_id' => \App\Models\Transaction::factory(),
        ];
    }
}
