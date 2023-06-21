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
            'name' => 'MWILA KILOBEKE Ben',
            'email' => 'mkbcentral@gmail.com',
            'phone_number' => '898337969',
            'password' => bcrypt('password'),
            'role_id' => RoleEnum::ADMINISTRATOR
        ]);
    }
}
