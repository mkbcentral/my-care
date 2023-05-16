<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerimissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allRoles=Role::all()->keyBy('id');

        $permissions=[
            'patient-manager'=>[Role::ROLE_DOCTOR],
            'clinic-manager'=>[Role::ROLE_ADMINISTRATOR],
        ];

        foreach ($permissions as $key => $roles){
            $permission=Permission::create(['name'=>$key]);
            foreach ($roles as $role){
                $allRoles[$role]->permissions()->attach($permission->id);
            }
        }

    }
}
