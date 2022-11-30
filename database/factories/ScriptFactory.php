<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScriptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'status_id' => $this->faker->numberBetween(1, 4),
            'authors' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'head' => $this->faker->sentence(),
            'doc' => $this->faker->fileExtension(),
        ];
    }
}
