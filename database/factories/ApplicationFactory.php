<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Kiosk;
use App\Models\Transaction;
use App\Models\User;
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
            'transaction_id' => Transaction::inRandomOrder()->pluck('id')->first(),
            'kiosk_id' => Kiosk::inRandomOrder()->pluck('id')->first(),
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => 'Pending',
        ];
    }
}
