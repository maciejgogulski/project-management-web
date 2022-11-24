<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 weeks'
            ),
            'deadline' => $this->faker->dateTimeBetween(
                '+ 4 weeks',
                '+ 8 weeks'
            ),
            'time_spent' => $this->faker->numberBetween(0, 60000)
        ];
    }
}
