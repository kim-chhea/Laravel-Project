<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $user = User::with(['location:id,address,city,postal_code','role:id,name'])->get(['id','name','email','location_id', 'role_id']);
            if(!$user)
            {
                return response()->json([
                   'message' => 'No users found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Users retrieved successfully.',
                'status' => 200,
                'data' => $user,
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
            "name" => "required|string|max:20",
            "email"=> "required|email|unique:users,email",
            "password" => "required|string|min:6|max:16",
            "location_id" => "nullable|integer",
            "role_id" => 'required|integer'
          ]);
          $ValidatedData['password'] = Hash::make($ValidatedData['password']);
          $user = User::create($ValidatedData);
          if(!$user)
          {
            throw new CustomeExceptions('User creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'User registered successfully.',
            'status' => 201,
            'data' => $user,
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

            $user = User::with(['location:id,address,city,postal_code','location:id,name'])->select(['id','name','email','location_id', 'role_id'])->findOrFail($id);
            return response()->json([
                'message' => 'Users retrieved successfully.',
                'status' => 200,
                'data' => $user,
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
            "name" => "sometimes|string|max:20",
            "email"=> "sometimes|email|unique:users,email,".$id,
            "password" => "sometimes|string|min:6|max:16",
            "location_id" => "sometimes|nullable|integer",
            "role_id" => 'sometimes|integer'
          ]);
          if(isset($ValidatedData['password']))
          {
          $ValidatedData['password'] = Hash::make($ValidatedData['password']);
          }

          $user = User::findOrFail($id);
          $updatedSuccess = $user->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('User updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'User updated successfully.',
            'status' => 200,
            'data' => $user,
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

            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'Users deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
}
