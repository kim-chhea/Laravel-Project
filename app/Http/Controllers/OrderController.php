<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\discount;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $discount = discount::get();
            if(!$discount)
            {
                return response()->json([
                   'message' => 'No discounts found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'discounts retrieved successfully.',
                'status' => 200,
                'data' => $discount,
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
            "title" => "required|string",
            "descriptions" => "required|string",
            "percentage" => "required|integer|min:1|max:100",
          ]);
         
          $discount = discount::create($ValidatedData);
          if(!$discount)
          {
            throw new CustomeExceptions('discount creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'discount created successfully.',
            'status' => 201,
            'data' => $discount,
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
    public function show($id)
    {
        try
        {

            $discount = discount::findOrFail($id);
            return response()->json([
                'message' => 'discounts retrieved successfully.',
                'status' => 200,
                'data' => $discount,
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
    public function update(Request $request, $id)
    {
        try
        {
          $ValidatedData = $request->validate([
            "title" => "sometimes|string",
            "descriptions" => "sometimes|string",
            "percentage" => "sometimes|integer|min:1|max:100",
         
          ]);

          $discount = discount::findOrFail($id);
          $updatedSuccess = $discount->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('discount updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'discount updated successfully.',
            'status' => 200,
            'data' => $discount,
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

            $discount = discount::findOrFail($id);
            $discount->delete();
            return response()->json([
                'message' => 'discounts deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
    public function assigndiscount( $userID , $discountID)
    {
        try
        {
             // Check if discount exists 
            $discount = discount::find($discountID);
            if (!$discount) {
            return response()->json([
                'message' => 'discount not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;
            // if it exit assign discount to it
            $user->discount_id = $discountID;
            $user->save();
            return response()->json([
                'message' => 'discount assigned successfully.',
                'status' => 200,
                'user' => $user
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }

    public function removediscount($userID , $discountID)
    {
        try
        {
             // Check if discount exists 
            $discount = discount::find($discountID);
            if (!$discount) {
            return response()->json([
                'message' => 'discount not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;

            if ($user->discount_id != $discountID) {
                return response()->json([
                    'message' => 'User does not have this discount.',
                    'status' => 400,
                ], 400);
            }
            // Remove discount
            $user->discount_id = 1;
            $user->save();
            return response()->json([
                'message' => 'discount removed successfully.',
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
