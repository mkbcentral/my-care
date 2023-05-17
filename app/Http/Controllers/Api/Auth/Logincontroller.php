<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class Logincontroller extends Controller
{
    public  function  __invoke(Request $request)
    {
        try {
            $request->validate([
                'login' => ['required', 'string', 'max:255'],
                'password' => ['required', Password::default()],
            ]);
            $user = User::where('email', $request->login)
                ->orWhere('phone_number', $request->login)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The email failed']
                ]);
            }
            return response()->json([
                'access_token' => $user->createToken('client')->plainTextToken,
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
