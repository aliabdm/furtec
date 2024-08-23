<?php

namespace Database\Seeders;

use App\Models\RoomPart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomPart::factory()->count(40)->create();
    }
}
