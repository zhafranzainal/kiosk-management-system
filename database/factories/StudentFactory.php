<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\KioskParticipant;
use App\Models\Student;
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
            'kiosk_participant_id' => KioskParticipant::factory(),
            'course_id' => Course::inRandomOrder()->pluck('id')->first(),
            'matric_no' => $this->faker->bothify('CB20###'),
            'year' => $this->faker->numberBetween(1, 4),
            'semester' => $this->faker->numberBetween(1, 3),
        ];
    }
}
