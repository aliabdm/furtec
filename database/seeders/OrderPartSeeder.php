<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Material;
use App\Models\OrderPart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        foreach ($orders as $key => $order) {
            $orderPart = new OrderPart();
            $orderPart->order_id = $order->id;
            $orderPart->material_id = Material::inRandomOrder()->limit(1)->first()->id;
            $orderPart->name = fake()->name();
            $orderPart->color = getRandomeColorString();
            $orderPart->count = fake()->randomDigit();
            $orderPart->thickness = fake()->randomFloat();
            $orderPart->height = fake()->randomFloat();
            $orderPart->width = fake()->randomFloat();
            $orderPart->image = "";
            $orderPart->save();
        }
    }
}
