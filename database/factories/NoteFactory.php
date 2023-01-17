<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $projectOrTaskNote = $this->faker->boolean;

        return [
            'project_id' => $projectOrTaskNote ? $this->faker->numberBetween(1, 30) : null,
            'task_id' => $projectOrTaskNote ? null : $this->faker->numberBetween(1, 300),
            'content' => $this->faker->sentences(3, true),
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 weeks'
            ),
        ];
    }
}
