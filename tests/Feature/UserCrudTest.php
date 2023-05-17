<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public  function test_create_new_user(){
        $role=Role::create(['name'=>'User']);
        $response=$this->postJson('api/v1/user',[
            'name'=>'My name',
            'email'=>'mayname@test.app',
            'password'=>'password',
            'role_id'=>$role->id
        ]);
        $response->assertStatus(200)->assertJsonStructure(['user']);
    }
    public function test_get_all_user_order_by_asc(){
        $response=$this->getJson('api/v1/user');
        $response->assertStatus(200);
    }
}
