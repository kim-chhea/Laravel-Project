<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\Hash;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $wishlist = wishlist::with(['user:id,name', 'services:id,title,price,description'])->get(['id', 'user_id',]);
            if(!$wishlist)
            {
                return response()->json([
                   'message' => 'No wishlists found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'wishlist retrieved successfully.',
                'status' => 200,
                'data' => $wishlist,
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
            "user_id" => "required|integer|unique:wishlists,user_id",
          ]);
          //check if that user_id alrady have wishlist or not
         $wishlist = wishlist::create($ValidatedData);
          if(!$wishlist)
          {
            throw new CustomeExceptions('wishlist creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'wishlist created successfully.',
            'status' => 201,
            'data' => $wishlist,
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

            $wishlist =wishlist::with(['services:id,title,description,price','user:id,name,email'])->select(['id','user_id'])->findOrFail($id);
            return response()->json([
                'message' => 'wishlist retrieved successfully.',
                'status' => 200,
                'data' => $wishlist,
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
                "user_id" => "sometimes|integer|unique:wishlists,user_id,".$id
              ]);

              $wishlist = wishlist::findOrFail($id);
              $updatedSuccess = $wishlist->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('wishlist updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'wishlist updated successfully.',
            'status' => 200,
            'data' => $wishlist,
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

            $wishlist =wishlist::findOrFail($id);
            $wishlist->delete();
            return response()->json([
                'message' => 'wishlist deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }

    public function addService(Request $request , $wishlistId)
    {
        try
        {

            $valideteData = $request->validate([
                "service_id" => "required|integer",
            ]);
            //find is that wishlist exits or not
            $wishlist =wishlist::findOrFail($wishlistId);
            //find is that service already exit in that wishlist or not
           $service = $wishlist->services()->where('service_id', $valideteData['service_id'])->exists();
            if($service)
            //return true or fail
            {
                return response()->json([
                    'message' => 'The services already had in that wishlist.',
                    'status' => 400,
                ]);
            } 
            else 
            {
                $wishlist->services()->attach($valideteData['service_id']);
            }
            return response()->json([
                'message' => 'Service added to wishlist successfully.',
                'status' => 200
            ]);
        }
        catch(Exception $e){
        throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    public function removeService(Request $request , $wishlistId)
    {
        try
        {
        $validatedate = $request->validate([
            "service_id" => 'required|integer'
        ]);
        //find wishlist base on id 
        $wishlist = wishlist::findOrFail($wishlistId);
        $service = $wishlist->services()->where('service_id', $request->input('service_id'))->exists();
        if(!$service)
        {
         throw new CustomeExceptions('Service not found in thiswishlist' , 404);
        }
            // remove it 
            $wishlist->services()->detach($validatedate['service_id']);

            return response()->json([
                'message' => 'Service removed from wishlist.',
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
                throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
        
}
