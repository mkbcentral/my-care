<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private  bool $status=false;
    private string $message='';
    private Permission $permission;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPermissions=Permission::orderBy('name','ASC')->get();
        return  PermissionResource::collection($allPermissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
        ]);
        $permissionToAdd=Permission::create([
            'name'=>$request->name
        ]);
        if ($permissionToAdd){
            $this->status=true;
            $this->message='Permission created successfully';
            $this->permission=$permissionToAdd;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'role'=>$this->permission
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->permission=Permission::find($id);
        return new PermissionResource($this->permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permissionToEdit=Permission::find($id);
        $permissionToEdit->name=$request->name;
        if ($permissionToEdit->update()){
            $this->status=true;
            $this->message='Permission updated successfully';
            $this->permission=$permissionToEdit;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'role'=>$this->permission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->permission=Permission::find($id);
        if($this->permission->delete()){
            $this->status=true;
            $this->message='Permission deleted successfully';
        }

        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
        ]);
    }
}
