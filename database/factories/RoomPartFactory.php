<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomPart>
 */
class RoomPartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->limit(1)->first()->id,
            'material_id' => Material::inRandomOrder()->limit(1)->first()->id,
            'name' => fake()->name(),
            'color' => getRandomeColorString(),
            'count' => fake()->randomDigit(),
            'thickness' => fake()->randomFloat(),
            'height' => fake()->randomFloat(),
            'width' => fake()->randomFloat()
        ];
    }
}
