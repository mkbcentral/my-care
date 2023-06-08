<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::default()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'type_role' => ['required']
        ]);
        try {
            if($request->type_role=='Patient'){
                $role=Role::where('name','PATIENT')->first();
            }else{
                $role=Role::where('name','DOCTOR')->first();
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'password_confirmation' => $request->password_confirmation,
                'role_id' => $role->id
            ]);
            return response()->json([
                'access_token' => $user->createToken('client')->plainTextToken,
                'user'=>new UserResource($user)
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
                'status'=>false
            ]);
        }
    }
}
