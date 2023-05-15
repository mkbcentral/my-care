<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public  function  test_registration_succeeds_with_admin_role(){
        $role=Role::create(['name'=>'Admin']);
        $response=$this->postJson('api/v1/register',[
            'name'=>'Valid Name',
            'email'=>'validemail@test.app',
            'password'=>bcrypt('password'),
            'role_id'=>$role->id
        ]);
        $response->assertStatus(200)->assertJsonStructure(['access_token']);
    }
}
