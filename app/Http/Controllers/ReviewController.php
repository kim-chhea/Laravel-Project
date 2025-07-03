<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\review;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $review = review::get();
            if(!$review)
            {
                return response()->json([
                   'message' => 'No reviews found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'reviews retrieved successfully.',
                'status' => 200,
                'data' => $review,
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
            "service_id" => "required|integer",
            "comment" => "required|string",
            "rating" => "required|integer|min:0|max:5"
          ]);
         

          $review = review::create($ValidatedData);
          if(!$review)
          {
            throw new CustomeExceptions('review creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'review created successfully.',
            'status' => 201,
            'data' => $review,
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

            $review = review::findOrFail($id);
            return response()->json([
                'message' => 'reviews retrieved successfully.',
                'status' => 200,
                'data' => $review,
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
                "user_id" => "sometimes|integer",
                "service_id" => "sometimes|integer",
                "comment" => "sometimes|string",
                "rating" => "sometimes|integer|min:0|max:5"
              ]);

          $review = review::findOrFail($id);
          $updatedSuccess = $review->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('review updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'review updated successfully.',
            'status' => 200,
            'data' => $review,
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
    public function destroy($id)
    {
        try
        {

            $review = review::findOrFail($id);
            $review->delete();
            return response()->json([
                'message' => 'reviews deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
    public function review(Request $request, $serviceId)
    {
        try
        {
             // Check if service exists 
            $service = Service::find($serviceId);
            if (!$service) {
            return response()->json([
                'message' => 'service not found.',
                'status' => 404,
            ], 404);
        }
        //validate data
        $ValidatedData = $request->validate([
            "user_id" => "required|integer",
            "service_id" => "sometimes|integer",
            "comment" => "required|string",
            "rating" => "required|integer|min:0|max:5"
          ]);

          $ValidatedData['service_id'] = $serviceId;

          // Check if this user already reviewed this service
          $existing = review::where('user_id', $ValidatedData['user_id'])
          ->where('service_id', $serviceId)
          ->first();
          
            if ($existing) 
           {
              return response()->json([
                  'message' => 'You have already reviewed this service.',
                  'status' => 409
                ], 409);
            } 

            // Create the review
            else
            {
                $review = review::create($ValidatedData);
                if($review)
                {
                return response()->json([
                  'message' => 'review assigned successfully.',
                  'status' => 201,
                  'review' => $review
                    ], 201);
                }
            }
           
 
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }

    public function reviewBaseOnId($serviceId)
    {
        try
        {
             // Check if review exists 
            $service = Service::find($serviceId);
            if (!$service) {
            return response()->json([
                'message' => 'service not found.',
                'status' => 404,
            ], 404);
        }
            
            $review = Service::with(['review:id,service_id,comment,rating,user_id','review.user:id,name,email'])->select('id', 'title', 'description', 'price')->findOrFail($serviceId);

            if (!$review) {
                return response()->json([
                    'message' => 'Service does not have the review.',
                    'status' => 400,
                ], 400);
            }
            return response()->json([
                'message' => 'review base on service retrieved review successfully.',
                'status' => 200,
                'services' => $review
            ], 200);
        } 
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(),500);
        }
    }
}
