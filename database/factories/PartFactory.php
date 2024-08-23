<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Workshop;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = ['green','blue','red'];
        return [
            'workshop_id' => Workshop::inRandomOrder()->limit(1)->first()->id,
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
