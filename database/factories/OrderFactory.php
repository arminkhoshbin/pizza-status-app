<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class OrderFactory extends Factory
{
    use WithFaker;

    public function definition(): array
    {
        return [
            'id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'user_id' => User::factory()->create(),
        ];
    }
}
