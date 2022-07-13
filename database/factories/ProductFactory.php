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
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'purchase_price' => $this->faker->numberBetween('500','1000'),
            'sale_price' => $this->faker->numberBetween('1000','1500'),
            'stock' => $this->faker->biasedNumberBetween,
            'category_id' => $this->faker->numberBetween('1','5'),
        ];
    }
}
