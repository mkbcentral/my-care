<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;

use App\Http\Resources\CategoryPatientResource;
use App\Models\CategoryPatient;
use Exception;
use Illuminate\Http\Request;

class CategoryPatientController extends Controller
{
    private bool $status = false;
    private string $message = '';
    private CategoryPatient $category;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategories = CategoryPatient::orderBy('name', 'ASC')->get();
        return CategoryPatientResource::collection($allCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:255'],
            ]);
            $categoryToAdd = CategoryPatient::create([
                'name' => $request->name,
            ]);
            if ($categoryToAdd) {
                $this->status = true;
                $this->message = 'Category patient created successfully';
                $this->category = $categoryToAdd;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'category' => $this->category
            ], 200);
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
            $this->category = CategoryPatient::find($id);
            return new CategoryPatientResource($this->category);
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
            $categoryToEdit = CategoryPatient::find($id);
            $categoryToEdit->name = $request->name;
            if ($categoryToEdit->update()) {
                $this->status = true;
                $this->message = 'Category patient updated successfully';
                $this->category = $categoryToEdit;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'category' => $this->category
            ], 200);
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
            $this->category = CategoryPatient::find($id);
            if ($this->category->delete()) {
                $this->status = true;
                $this->message = 'Category deleted successfully';
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message
            ], 200);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}

