<?php

namespace Database\Factories;

use App\Models\Kiosk;
use Illuminate\Support\Str;
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
            'name' => $this->faker->name(),
            'location' => $this->faker->text(255),
            'suggested_action' => 'No Action',
            'comment' => $this->faker->text(),
            'status' => 'Inactive',
            'business_type_id' => \App\Models\BusinessType::factory(),
        ];
    }
}
