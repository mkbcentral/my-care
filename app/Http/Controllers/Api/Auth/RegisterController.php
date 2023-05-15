<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\RoleEnums;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','confirmed',Password::default()],
            'email'=>['required','string','email','max:255','unique:users,email'],
            'role_id'=>['required',Rule::in(RoleEnums::ADMINISTRATOR,RoleEnums::DOCTOR)]
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role_id'=>$request->role_id
        ]);
        return response()->json([
            'access_token' => $user->createToken('client')->plainTextToken,
        ]);
    }
}
