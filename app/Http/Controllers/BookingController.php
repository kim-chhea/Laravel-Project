<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\booking;
use App\Models\cart;
use App\Models\review;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $booking = booking::with(['user:id,name', 'services:id,title,price,description',])->get(['id', 'user_id',]);
            if(!$booking)
            {
                return response()->json([
                   'message' => 'No bookings found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'booking retrieved successfully.',
                'status' => 200,
                'data' => $booking,
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
            "user_id" => "required|integer|unique:bookings,user_id",
          ]);
          //check if that user_id alrady have booking or not
         $booking = booking::create($ValidatedData);
          if(!$booking)
          {
            throw new CustomeExceptions('booking creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'booking created successfully.',
            'status' => 201,
            'data' => $booking,
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

            $booking =booking::with(['services:id,title,description,price','user:id,name,email'])->select(['id','user_id'])->findOrFail($id);
            return response()->json([
                'message' => 'booking retrieved successfully.',
                'status' => 200,
                'data' => $booking,
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
                "user_id" => "sometimes|integer|unique:bookings,user_id,".$id
              ]);

              $booking = booking::findOrFail($id);
              $updatedSuccess = $booking->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('booking updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'booking updated successfully.',
            'status' => 200,
            'data' => $booking,
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

            $booking = booking::findOrFail($id);
            $booking->delete();
            return response()->json([
                'message' => 'booking deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }

    public function addService(Request $request , $bookingId , $serviceId)
    {
        try
        {

            $valideteData = $request->validate([
                "booking_data" => "required|date",
                "time_slot" => "required|date_format:H:i:s",
                "status" => "required|string",
            ]);
            //find is that booking is it exits or not
            $booking = booking::findOrFail($bookingId);
            $service = Service::findOrFail($serviceId);

            //find is that service already exit in that booking or not
           $service = $booking->services()->where('service_id', $serviceId)->exists();
           // return true or fail
            if($service)
            {
                return response()->json([
                    'message' => 'The services already had in that booking.'
                ]);
            } 
            else 
            {
                $booking->services()->attach($serviceId,[
                    "booking_date" => $valideteData['booking_data'],
                    "time_slot" => $valideteData['time_slot'],
                    "status" => $valideteData['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return response()->json([
                'message' => 'Service added to booking successfully.',
                'status' => 200,
                'data' => $service
            ]);
        }
        catch(Exception $e){
        throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    public function removeService(Request $request , $bookingId,$serviceId)
    {
        try
        {
        //find booking base on id 
        $booking = booking::findOrFail($bookingId);
        $service = booking::findOrFail($serviceId);
        $service = $booking->services()->where('service_id', $serviceId)->exists();
        if(!$service)
        {
         throw new CustomeExceptions('Service not found in this booking' , 404);
        }
            // remove it 
            $booking->services()->detach($serviceId);

            return response()->json([
                'message' => 'Service removed from booking.',
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
                throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
        public function checkoutfromcart(Request $request)
        {
            //validate user id
            $data = $request->validate([
                "user_id" => "required|integer|exists:users,id"
            ]);
            //check if that cart have service or not
            $cart = cart::with('services')->get()->where('user_id', $data['user_id'])->first();
            if(!$cart)
            {
                return response()->json([
                    'message' => 'Cart is empty or not found',
                    'status' => 400
                ]);
            }
            //create new booking 
            $booking = booking::create([
                'user_id' => $data['user_id']
            ]);
            // Attach services from cart to booking
            foreach ($cart->services as $service) {
                $booking->services()->attach($service->id, [
                    'booking_date' => now()->toDateString(),
                    'time_slot' => now()->format('H:i:s'),
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            //clear cart list
            $cart->services()->detach();
             // Step 7: Return success response
             return response()->json([
                'message' => 'Booking created successfully from cart.',
                'status' => 201,
                'data' => $booking->load('services')
    ]); 
        }
        
}
