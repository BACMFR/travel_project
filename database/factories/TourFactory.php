<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'starting_date' => $this->faker->date,
            'ending_date' => $this->faker->date,
            'price' => $this->faker->numberBetween(100, 1000),
            'travel_id' => Travel::inRandomOrder()->first()->id,
        ];
    }
}
