<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (App::environment() === 'production') {
            echo ("Production mode seeding \n");
            $this->call($this->getProductionModeSeeders());
        } else {
            echo ("Development mode seeding \n");

            $productionSeeders = $this->getProductionModeSeeders();
            $developmentSeeders = $this->getDevelopmentModeSeeders();

            $seeders = array_merge($productionSeeders, $developmentSeeders);

            $this->call($seeders);
        }
    }

        public function getProductionModeSeeders()
    {
        return [
            TruncateAllTables::class,
            RoleSeeder::class,
            MaterialSeeder::class
        ];
    }

    public function getDevelopmentModeSeeders()
    {
        return [
            UserSeeder::class,
            WorkshopSeeder::class,
            PartSeeder::class,
            RoomSeeder::class,
            RoomPartSeeder::class,
            OrderSeeder::class,
            OrderPartSeeder::class
        ];
    }

}
