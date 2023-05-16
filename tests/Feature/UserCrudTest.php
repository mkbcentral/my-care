<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public  function test_create_new_user(){
        $response=$this->postJson('api/v1/user',[
            'name'=>'Valid Name',
            'email'=>'validemail@test.app',
            'password'=>'password',
            'role_id'=>1
        ]);
        $response->assertStatus(200)->assertJsonStructure(['access_token']);
    }
}
