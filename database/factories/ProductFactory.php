<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img'=>$this->faker->imageUrl(640,480),
            'rate'=>$this->faker->numberBetween(1,5),
            'category'=>$this->faker->realText($maxNbchars=10),
            'name'=>$this->faker->name,
            'price'=>$this->faker->numberBetween(0,10000000),
            'amount'=>$this->faker->numberBetween(0,1000)
        ];
    }
}
