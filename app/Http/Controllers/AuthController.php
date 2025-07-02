<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try
        {
            //validate input field
            $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:16'
        ]);

           // get value from user input
            $email = $request->input('email');
            $password = $request->input('password');
            //get user from email that mactch
            $user = User::where('email',$email)->first();
            // check that email and password match with user email and pw in database or not
            if(!$user || !Hash::check($password,$user->password))
            {
             throw new CustomeExceptions("The provided credentials are incorrect." , 400);
            }
            //create token 
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'message' => 'Verified successfully',
                'status' => 200,
                'token' => $token,
            ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
       
        
    }
    public function register(Request $request)
    {
        try
        {
            // get user info , validate
          $ValidatedUser = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string",
            "role_id" => "required",
            "location_id" => "nullable"

          ]);
          // hash password
          $ValidatedUser['password'] = Hash::make($ValidatedUser['password']);
          // creat user
          $user = User::create($ValidatedUser);
          if($user)
          {
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'message' => 'Registration successful',
                'status' => 201,
                'token' => $token,
            ]);
      
          }
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
    public function logout(Request $request)
    {
    
     try
     {
         
         $user = $request->user('sanctum');
        // get user object
         if(!$user)
         {
             throw new CustomeExceptions('Unauthentication' , 401);
         }
         $token = $user->currentAccessToken();
         // access to current token in database (hashed token)
         if($token)
         {
             $token->delete();
             $user->delete();
             return response()->json(['message' => 'Logged out successfully', "status" => 200]);
         }
         return response()->json(['message' => 'No active token found.'], 400);
     }
     catch(Exception $e)
    {
      throw new CustomeExceptions($e->getMessage(),500);
    }
 
    }
}
