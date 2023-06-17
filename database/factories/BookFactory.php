<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->words(3,true),
            'edition'=> $this->faker->words(3,true),
            'type'=> $this->faker->words(3,true),
            'price' => mt_rand(100, 10000),
            'sale-price' => mt_rand(100, 10000),
        ];
    }
}
