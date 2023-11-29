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
            'user_id' => $this->faker->numberBetween(1,10),
            'total_price' => $this->faker->randomNumber(7),
            'shipment_status' => $this->faker->randomElement(["Pending","Processing","Shipped","Delivered"]),
            'payment_status' => $this->faker->randomElement(["paid", "accepted", "rejected"]),
            'payment_proof' => 'product-1.jpg',
            'shipping_address' => $this->faker->address(),
            'payment_method' => $this->faker->randomElement(['BCA','Mandiri','Gopay','Ovo']),
        ];
    }
}
