<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RoleController extends Controller
{
    private  bool $status = false;
    private string $message = '';
    private Role $role;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allRoles = Role::orderBy('name', 'ASC')->get();
            return RoleResource::collection($allRoles);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $roleToAdd = Role::create([
                'name' => $request->name
            ]);
            if ($roleToAdd) {
                $this->status = true;
                $this->message = 'Role created successfully';
                $this->role = $roleToAdd;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'role' => $this->role
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->role = Role::find($id);
            return new RoleResource($this->role);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $roleToEdit = Role::find($id);
            $roleToEdit->name = $request->name;
            if ($roleToEdit->update()) {
                $this->status = true;
                $this->message = 'Role updated successfully';
                $this->role = $roleToEdit;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'role' => $this->role
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->role = Role::find($id);
            if ($this->role->delete()) {
                $this->status = true;
                $this->message = 'Role deleted successfully';
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
