<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), 
            'cart_id' => Cart::factory(), 
            'quantity' => $this->faker->numberBetween(1, 10), 
            'price' => $this->faker->randomFloat(2, 10, 100), 
            'subtotal' => $this->faker->randomFloat(2, 10, 100), 
            'tumbnail' => $this->faker->imageUrl(),
        ];
    }
}
