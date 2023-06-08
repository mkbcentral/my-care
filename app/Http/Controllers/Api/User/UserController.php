<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout()
    {
        if (auth()->user()->tokens()->delete()) {
            return response()->json([
                'message' => 'Your logout !',
            ]);
        }
    }
    public function getUserInfos($id){
        $user=User::find($id);
        return response()->json([
            'user' => new UserResource($user) ,
        ]);
    }
}
