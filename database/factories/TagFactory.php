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
    public function definition()
    {
        $title = $this->faker->title;
        return [
            'name' => $title,
            'slug' => $title,
            'description' => implode(' ', $this->faker->sentences(2)),
            'picture' => 'picture/logo_studio.png',
        ];
    }
}
