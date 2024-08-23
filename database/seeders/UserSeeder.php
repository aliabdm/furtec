<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create admin

        //create Owner
        $user = new User();
        $user->username = '123456789';
        $user->password = Hash::make('123456789');
        $user->name = "Owner";
        $user->role_id = Role::OWNER;
        $user->save();

        $user = new User();
        $user->username = '12345678';
        $user->password = Hash::make('12345678');
        $user->name = "worker";
        $user->role_id = Role::WORKER;
        $user->workshop_id = 2;
        $user->save();
    }
}
