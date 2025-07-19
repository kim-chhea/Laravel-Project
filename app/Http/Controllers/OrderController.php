<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\order;
use App\Models\payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use function PHPUnit\Framework\isEmpty;

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
            $order = Order::with([
                'payment:id,booking_id,price,payment_method,transaction_id,status',
                'payment.booking:id,user_id',
                'payment.booking.user:id,name',
                'payment.booking.user.cart:id,user_id',
                'payment.booking.user.cart.services:id,title,description,price'
            ])->get(['id', 'user_id', 'payment_id', 'status']);
            
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
            "status" => "required|string",
            'payment_id' => 'required|integer'
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
    public function getReceipt(Request $request)
    {
        try
        {
            //validate data
        $data = $request->validate(
            [ 
              'user_id' => 'required|integer|exists:users,id',
              'payment_id' => 'required|integer|exists:,payments,id',
        ]
    );
         //check if order base on id exit or not if it not create one 
         $order = order::where('payment_id',$data['payment_id'])->first();
         if(! $order)
         {
            $payment = Payment::with('booking.user')->findOrFail($data['payment_id']);
            if ($payment->booking->user->id != $data['user_id']) {
                return response()->json([
                    'message' => 'Unauthorized: Payment does not belong to this user.',
                    'status' => 403,
                ]);
            }
            else
            {
                // check the status of payment and bind it to order
                if ($payment->status === 'paid') {
                    $order->status = 'paid';
                    $order->save();
                }
                if ($payment->status === 'pending') {
                    $order->status = 'pending';
                    $order->save();
                }
            
            $order = Order::create([
                'user_id'     => $data['user_id'],
                'payment_id'  => $data['payment_id'],
                'status'      => $payment->status === 'paid' ? 'paid' : 'pending',
            ]);

            }
            return response()->json([
                'message' => 'Receipt retrieved successfully.',
                'order' => $order,
                'payment' => $payment,
            ]);
         }
         else
         {
             // 6. If order exists → return it
            $order = Order::with('payment')->where('payment_id', $data['payment_id'])->first();

            return response()->json([
            'message' => 'Receipt retrieved successfully.',
            'order'   => $order,
            'payment' => $order->payment,
        ]);
         }
         }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
   
}
