<?php

namespace Database\Factories;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'category' => $this->faker->randomElement(['technical', 'non-technical']),
            'course_code' => $this->faker->word
        ];
    }



}
