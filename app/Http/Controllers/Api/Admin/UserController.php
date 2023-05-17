<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private  bool $status=false;
    private string $message='';
    private User $user;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUsers=User::orderBy('name','ASC')->get();
        return UserResource::collection($allUsers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('user-manager');
        try {
            $request->validate([
                'name'=>['required','string','max:255'],
                //'password'=>['required',Password::default()],
                'email'=>['required','string','email','max:255','unique:users,email'],
                'role_id'=>['required',Rule::in(Role::ROLE_ADMINISTRATOR,Role::ROLE_DOCTOR,Role::ROLE_NURSE)]
            ]);
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt('password'),
                'role_id'=>$request->role_id
            ]);
            if ($user){
                $this->status=true;
                $this->message='User created successfully';
                $this->user=$user;
            }
            return response()->json([
                'status'=>$this->status,
                'message'=>$this->message,
                'user'=>$this->user
            ]);
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('user-manager');
        $this->user=User::find($id);
        return new UserResource($this->user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('user-manager');
        $userToEdit=User::find($id);
        $userToEdit->name=$request->name;
        $userToEdit->email=$request->email;
        $userToEdit->phone_number=$request->phone_number;
        $userToEdit->role_id=$request->role_id;
        if($userToEdit->update()){
            $this->status=true;
            $this->message='User updated successfully';
            $this->user=$userToEdit;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'user'=>$this->user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('user-manager');
        $this->user=User::find($id);
        if ($this->user->delete()){
            $this->status=true;
            $this->message='User deleted successfully';
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
        ]);
    }
}
