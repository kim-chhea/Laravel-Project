<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $location = Location::get();
            if(!$location)
            {
                return response()->json([
                   'message' => 'No locations found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'locations retrieved successfully.',
                'status' => 200,
                'data' => $location,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
          $ValidatedData = $request->validate([
            "address" => "required|string",
            "city" => "required|string",
            "postal_code" => "required|integer"
          ]);
         
          $location = location::create($ValidatedData);
          if(!$location)
          {
            throw new CustomeExceptions('location creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'location created successfully.',
            'status' => 201,
            'data' => $location,
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try
        {

            $location = location::findOrFail($id);
            return response()->json([
                'message' => 'locations retrieved successfully.',
                'status' => 200,
                'data' => $location,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try
        {
            $ValidatedData = $request->validate([
                "address" => "sometimes|string",
                "city" => "sometimes|string",
                "postal_code" => "sometimes|string"
              ]);
             

          $location = location::findOrFail($id);
          $updatedSuccess = $location->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('location updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'location updated successfully.',
            'status' => 200,
            'data' => $location,
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {

            $location = location::findOrFail($id);
            $location->delete();
            return response()->json([
                'message' => 'locations deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
}
