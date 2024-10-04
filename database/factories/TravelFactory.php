<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelFactory extends Factory
{
    protected $model = Travel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text(255),
            'is_public' => $this->faker->boolean,
            'number_of_days' => $this->faker->numberBetween(1, 10),
        ];
    }
}
