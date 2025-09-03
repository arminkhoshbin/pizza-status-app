<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class OrderHistoryFactory extends Factory
{
    use WithFaker;

    public function definition(): array
    {
        return [
            'id' => $this->faker->randomNumber(),
            'order_id' => Order::factory()->create(),
            'status' => 'making',
        ];
    }
}
