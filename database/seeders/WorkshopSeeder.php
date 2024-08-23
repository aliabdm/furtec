<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Role;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use App\Models\WorkshopTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = [
            'en',
            'ar'
        ];
        $faker = Factory::create();

        // $filepath_product = public_path('storage/product');
        // if (!File::exists($filepath_product)) {
        //     File::makeDirectory($filepath_product, 0777, true);
        // }

        // File::copy(public_path('public_images/default.jpg'), public_path('storage/workshop/default.jpg'));

        $user = User::where('role_id',Role::OWNER)->first();
        for ($i=0; $i < 3 ; $i++) {
            $workshop = new Workshop();
            $workshop->user_id = $user->id;
            $workshop->image = 'workshop/default.jpg';
            foreach ($langs as $lang) {
                $workshop->translateOrNew($lang)->title = $faker->name;
                $workshop->translateOrNew($lang)->content = $faker->realText(20,2);
            }
            $workshop->save();
        }
    }
}
