<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private bool $status = false;
    private string $message = '';
    private Country $country;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allCountries = Country::orderBy('name', 'ASC')->get();
            return CountryResource::collection($allCountries);
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
                'name' => ['required', 'max:255'],
                'country_code' => ['nullable']
            ]);
            $countryToAdd = Country::create([
                'name' => $request->name,
                'country_code' => $request->country_code
            ]);
            if ($countryToAdd) {
                $this->status = true;
                $this->message = 'Country created successfully';
                $this->country = $countryToAdd;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'country' => $this->country
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
            $this->country = Country::find($id);
            return new CountryResource($this->country);
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
            $countryToEdit = Country::find($id);
            $countryToEdit->name = $request->name;
            $countryToEdit->country_code = $request->country_code;
            if ($countryToEdit->update()) {
                $this->status = true;
                $this->message = 'Country created successfully';
                $this->country = $countryToEdit;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'country' => $this->country
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
            $this->country = Country::find($id);
            if ($this->country->delete()) {
                $this->status = true;
                $this->message = 'Country deleted successfully';
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
