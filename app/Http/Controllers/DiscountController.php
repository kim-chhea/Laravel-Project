<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\discount;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class DiscountController extends Controller
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
            "title" => "required|string|unique:discounts,title",
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
            "title" => "sometimes|string|unique:discounts,title,".$id,
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
    public function assigndiscount($discountID , $serviceID)
    {
        try
        {
             // Check if discount exists 
            $discount = discount::findOrFail($discountID);
            $service = Service::findOrFail($serviceID);
            // check if that discout had in the service or not
            $exist = $discount->service()->where('service_id',$serviceID)->exists();
            // if it exit assign
            if($exist)
            {
                return response()->json([
                    'message' => 'discount already exits in that service',
                    'status' => 400,
             ], 400);
            }
            else
            {
             // assigne dicount to that service 
             $discount->service()->attach($serviceID);
             //calculate that price with the discount 
             // get original price
             $original_price = $service->price;
             $discountPercent = $discount->percentage;
             $discountedPrice = (float) $original_price - ((float) $original_price * (float) $discountPercent) / 100;
            //  show it 
            return response()->json([
                'message' => 'Discount assigned successfully.',
                'original_price' => $original_price,
                'discount_percent' => $discountPercent,
                'discounted_price' => $discountedPrice,
                'status' => 200
            ], 200);
            }
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }

    public function removediscount($discountID , $serviceID)
    {
        try
        {
             // Check if discount exists 
            $discount = discount::find($discountID);
            $service = Service::findOrFail($serviceID);
            // find that user
             $exist =  $discount->service()->where('service_id', $serviceID)->exists();
            if (!$exist) {
                return response()->json([
                    'message' => 'This discount is not assigned to the service.',
                    'status' => 400,
                ], 400);
            }
            // Remove discount from the service 
             $discount->service()->detach($serviceID);
            return response()->json([
                'message' => 'Discount removed successfully.',
                'status' => 200,
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }
}
