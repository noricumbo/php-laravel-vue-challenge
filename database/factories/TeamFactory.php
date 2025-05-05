<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $team_name = ucfirst( fake()->unique()->words(2, true) );

        return [
            'name' => $team_name,
            'slug' => Str::slug( $team_name ),
            'color' => fake()->unique()->hexColor(),
        ];
    }
}
