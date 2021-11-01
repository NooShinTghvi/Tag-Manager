<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $title = $this->faker->unique->userName;
        return [
            'name' => $title,
            'slug' => $title,
            'description' => implode(' ', $this->faker->sentences(2)),
            'picture' => 'picture/logo_studio.png',
        ];
    }
}
