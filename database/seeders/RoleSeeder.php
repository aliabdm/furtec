<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles_rows = [
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ];
        DB::table('roles')->insert($roles_rows);
        DB::table('roles')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $roles_translations_rows = [
            ['id' => 1, 'role_id' => 1, 'locale' => 'en', 'name' => 'Admin'],
            ['id' => 2, 'role_id' => 1, 'locale' => 'ar', 'name' => 'اداري'],
            ['id' => 3, 'role_id' => 2, 'locale' => 'en', 'name' => 'Owner'],
            ['id' => 4, 'role_id' => 2, 'locale' => 'ar', 'name' => 'صاحب متجر'],
            ['id' => 5, 'role_id' => 3, 'locale' => 'en', 'name' => 'Worker'],
            ['id' => 6, 'role_id' => 3, 'locale' => 'ar', 'name' => 'عامل'],
        ];

        DB::table('role_translations')->insert($roles_translations_rows);

        DB::table('role_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
