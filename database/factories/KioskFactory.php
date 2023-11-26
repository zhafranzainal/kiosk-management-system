<?php

namespace Database\Factories;

use App\Models\BusinessType;
use App\Models\Kiosk;
use Illuminate\Database\Eloquent\Factories\Factory;

class KioskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kiosk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_type_id' => BusinessType::inRandomOrder()->pluck('id')->first(),
            'name' => $this->faker->word(),
            'location' => $this->faker->sentence(),
            'suggested_action' => 'No Action',
            'comment' => $this->faker->sentence(),
            'status' => 'Inactive',
        ];
    }
}
