<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matric_no' => $this->faker->text(255),
            'year' => $this->faker->numberBetween(0, 127),
            'semester' => $this->faker->numberBetween(0, 127),
            'course_id' => \App\Models\Course::factory(),
            'kiosk_participant_id' => \App\Models\KioskParticipant::factory(),
        ];
    }
}
