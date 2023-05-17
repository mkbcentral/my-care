<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Administrator',
            'email'=>'administrator@test.app',
            'phone_number'=>'971330007',
            'password'=>bcrypt('password'),
            'role_id'=>RoleEnum::ADMINISTRATOR
        ]);
    }
}
