<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'topic'=>fake()->text(),
            'user_id'=>fake()->randomNumber(1,100),
            'subject'=>fake()->text(),
            'essay_type'=>fake()->text(),
            'pages'=>fake()->randomDigit(),
            'deadline'=>fake()->date(),
            'description'=>fake()->paragraph(),
        ];
    }
}
