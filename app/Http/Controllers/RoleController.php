<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $role = Role::get(['id','name']);
            if(!$role)
            {
                return response()->json([
                   'message' => 'No roles found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'roles retrieved successfully.',
                'status' => 200,
                'data' => $role,
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
            "name" => "required|string|unique:roles,name",
          ]);
         
          $role = Role::create($ValidatedData);
          if(!$role)
          {
            throw new CustomeExceptions('Role creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'Role created successfully.',
            'status' => 201,
            'data' => $role,
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

            $role = Role::findOrFail($id);
            return response()->json([
                'message' => 'roles retrieved successfully.',
                'status' => 200,
                'data' => $role,
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
            "name" => "sometimes|string|max:20|unique:roles,name,".$id,
         
          ]);

          $role = Role::findOrFail($id);
          $updatedSuccess = $role->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('Role updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'Role updated successfully.',
            'status' => 200,
            'data' => $role,
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

            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json([
                'message' => 'roles deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
    public function assignRole( $userID , $roleID)
    {
        try
        {
             // Check if role exists 
            $role = Role::find($roleID);
            if (!$role) {
            return response()->json([
                'message' => 'Role not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;
            // if it exit assign role to it
            $user->role_id = $roleID;
            $user->save();
            return response()->json([
                'message' => 'Role assigned successfully.',
                'status' => 200,
                'user' => $user
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }

    public function removeRole($userID , $roleID)
    {
        try
        {
             // Check if role exists 
            $role = Role::find($roleID);
            if (!$role) {
            return response()->json([
                'message' => 'Role not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;

            if ($user->role_id != $roleID) {
                return response()->json([
                    'message' => 'User does not have this role.',
                    'status' => 400,
                ], 400);
            }
            // Remove role
            $user->role_id = 1;
            $user->save();
            return response()->json([
                'message' => 'Role removed successfully.',
                'status' => 200,
                'user' => $user
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }
}
