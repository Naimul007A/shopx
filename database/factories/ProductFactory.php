<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'title'             => $this->faker->title(),
            'short_description' => $this->faker->realText( 250 ),
            'description'       => $this->faker->realText(),
            'category_id'       => random_int( 1, 5 ),
            'price'             => random_int( 100, 1000 ),
        ];
    }
}