<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials_rows = [
            ['id' => 1],
            ['id' => 2],
        ];
        DB::table('materials')->insert($materials_rows);
        DB::table('materials')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $materials_translations_rows = [
            ['id' => 1, 'material_id' => 1, 'locale' => 'en', 'name' => 'Wood'],
            ['id' => 2, 'material_id' => 1, 'locale' => 'ar', 'name' => 'خشب'],
            ['id' => 3, 'material_id' => 2, 'locale' => 'en', 'name' => 'Metal'],
            ['id' => 4, 'material_id' => 2, 'locale' => 'ar', 'name' => 'حديد'],
        ];

        DB::table('material_translations')->insert($materials_translations_rows);

        DB::table('material_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
