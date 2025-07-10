<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $payment = payment::with(['booking:id,user_id','booking.services:title,description,price'])->get(['id','booking_id' ,'price' ,'status','payment_method', 'transaction_id']);
            if(!$payment)
            {
                return response()->json([
                   'message' => 'No payments found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'payments retrieved successfully.',
                'status' => 200,
                'data' => $payment,
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
            "booking_id" => "required|integer|",
            "price" => "required|integer|min:1",
            "payment_method"=> "required|string",
            "transaction_id" => "required|string"
          ]);
          //check if that user_id alrady have payment or not
         $payment = payment::create($ValidatedData);
          if(!$payment)
          {
            throw new CustomeExceptions('payment creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'payment created successfully.',
            'status' => 201,
            'data' => $payment,
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

            $payment = payment::with(['booking:id,user_id','booking.services:title,description,price'])->select(['booking:id,user_id','booking.services:title,description,price'])->select(['id','booking_id' ,'price' ,'status','payment_method', 'transaction_id'])->findOrFail($id);
            return response()->json([
                'message' => 'payments retrieved successfully.',
                'status' => 200,
                'data' => $payment,
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
    public function update(Request $request,$id)
    {
        try
        {
            $ValidatedData = $request->validate([
                "booking_id" => "sometimes|integer|",
                "price" => "sometimes|integer|min:1",
                "payment_method"=> "sometimes|string",
                "transaction_id" => "sometimes|string"
              ]);

              $payment = payment::findOrFail($id);
              $updatedSuccess = $payment->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('payment updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'payment updated successfully.',
            'status' => 200,
            'data' => $payment,
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

            $payment = payment::findOrFail($id);
            $payment->delete();
            return response()->json([
                'message' => 'payments deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }

    public function addTopayment(Request $request , $paymentId)
    {
        try
        {

            $valideteData = $request->validate([
                "service_id" => "required|integer",
                "quantity" => "nullable|integer|min:1"
            ]);
            //find is that payment exits or not
            $payment = payment::findOrFail($paymentId);
            //get qty
            $quantity = $valideteData['quantity'] ?? 1;
            //find is that service already exit in that payment or not
            $service = $payment->services()->where('service_id',$valideteData['service_id'])->first();
            if($service)
            {
                $currentQty = $service->pivot->quantity;
                $payment->services()->updateExistingPivot($valideteData['service_id'], [
                    'quantity' => $currentQty + $quantity
                ]);
            } 
            else 
            {
                $payment->services()->attach($valideteData['service_id'], [
                    'quantity' => $quantity
                ]);
            }
            return response()->json([
                'message' => 'Service added to payment successfully.',
                'status' => 200
            ]);
        }
        catch(Exception $e){
        throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    public function removeService(Request $request , $paymentId)
    {
        try
        {
        $validatedate = $request->validate([
            "service_id" => 'required|integer'
        ]);
        //find payment base on id 
        $payment = payment::findOrFail($paymentId);
        $service = $payment->services()->where('service_id', $request->input('service_id'))->exists();
        if(!$service)
        {
         throw new CustomeExceptions('Service not found in this payment' , 404);
        }
            // remove it 
            $payment->services()->detach($validatedate['service_id']);

            return response()->json([
                'message' => 'Service removed from payment.',
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
                throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
        
}
