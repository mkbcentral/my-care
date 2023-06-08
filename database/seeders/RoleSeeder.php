<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['name'=>'ADMINISTRATOR'],
            ['name'=>'DOCTOR'],
            ['name'=>'NURSE'],
            ['name'=>'RECEPTIONIST'],
            ['name'=>'PATIENT']
        ];
        Role::insert($data);
    }
}
