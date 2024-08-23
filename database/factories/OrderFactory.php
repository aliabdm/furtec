<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use App\Models\Order;
use App\Models\Workshop;
use Illuminate\Support\Arr;
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
    public function definition(): array
    {
        $statuses = [
            Order::PENDING,
            Order::PROCESSING,
            Order::COMPLETED,
            Order::RECEIVED,
            Order::CANCELLED,
        ];

        return [
            'name' => fake()->name(),
            'receiver_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'note' => fake()->paragraph(),
            'room_id' => Room::inRandomOrder()->limit(1)->first()->id,
            'workshop_id' => Workshop::inRandomOrder()->limit(1)->first()->id,
            'status' => Arr::random($statuses),
            'created_by' => User::inRandomOrder()->limit(1)->first()->id,
            'task_id' => fake()->randomDigit(),
            'delivery_date' => fake()->dateTime()
        ];
    }
}
