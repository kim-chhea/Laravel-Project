<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\order;
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

            $order = order::get();
            if(!$order)
            {
                return response()->json([
                   'message' => 'No orders found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'orders retrieved successfully.',
                'status' => 200,
                'data' => $order,
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
            "user_id" => "required|integer",
            "total_price" => "required|integer",
            "status" => "required|string",
          ]);
         
          $order = order::create($ValidatedData);
          if(!$order)
          {
            throw new CustomeExceptions('order creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'order created successfully.',
            'status' => 201,
            'data' => $order,
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

            $order = order::findOrFail($id);
            return response()->json([
                'message' => 'orders retrieved successfully.',
                'status' => 200,
                'data' => $order,
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
            "user_id" => "sometimes|integer",
            "total_price" => "sometimes|integer",
            "status" => "sometimes|string",
         
          ]);

          $order = order::findOrFail($id);
          $updatedSuccess = $order->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('order updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'order updated successfully.',
            'status' => 200,
            'data' => $order,
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

            $order = order::findOrFail($id);
            $order->delete();
            return response()->json([
                'message' => 'orders deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
    public function assignorder( $userID , $orderID)
    {
        try
        {
             // Check if order exists 
            $order = order::find($orderID);
            if (!$order) {
            return response()->json([
                'message' => 'order not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;
            // if it exit assign order to it
            $user->order_id = $orderID;
            $user->save();
            return response()->json([
                'message' => 'order assigned successfully.',
                'status' => 200,
                'user' => $user
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }

    public function removeorder($userID , $orderID)
    {
        try
        {
             // Check if order exists 
            $order = order::find($orderID);
            if (!$order) {
            return response()->json([
                'message' => 'order not found.',
                'status' => 404,
            ], 404);
        }
            // find that user
            $user =  User::findOrFail($userID) ;

            if ($user->order_id != $orderID) {
                return response()->json([
                    'message' => 'User does not have this order.',
                    'status' => 400,
                ], 400);
            }
            // Remove order
            $user->order_id = 1;
            $user->save();
            return response()->json([
                'message' => 'order removed successfully.',
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
