<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Category;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $service = service::with(['categories'])->get(['id','title','description','price']);
            if(!$service)
            {
                return response()->json([
                   'message' => 'No services found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'services retrieved successfully.',
                'status' => 200,
                'data' => $service,
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
            "description" => "required|string",
            "price" => "required|integer",
            "category_id" => "required|integer",
          ]);

          $service = service::create(
            [
            'title' => $ValidatedData['title'],
            'description' => $ValidatedData['description'],
            'price' => $ValidatedData['price'],
            ]);

          $service->categories()->attach($ValidatedData['category_id']);
          if(!$service)
          {
            throw new CustomeExceptions('service creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'service created successfully.',
            'status' => 201,
            'data' => $service->load('categories'),
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

            $service = service::with(['categories:name'])->select(['id','title','description','price'])->findOrFail($id);
            return response()->json([
                'message' => 'services retrieved successfully.',
                'status' => 200,
                'data' => $service,
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
                "title" => "sometimes|string",
                "description" => "sometimes|string",
                "price" => "sometimes|integer",
                "category_id" => "sometimes|integer",
              ]);

              $service = service::findOrFail($id);

                //check is category is set or not 
              if(isset($ValidatedData['category_id']))
              {
                Category::findOrFail($ValidatedData['category_id']);
                // check is category id already exit in that service already or not
                $alreadyExit = $service->categories()->where('categories.id',$ValidatedData['category_id'])->exists();
                //  if it not
                if(!$alreadyExit)
                {
                    $service->categories()->attach($ValidatedData['category_id']);
                }
                else
                {
                    return response()->json([
                        "messsge" => "that category already existed in the service",
                        "status" => 400
                    ]);
                }
                
              }

             $updatedSuccess = $service->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('service updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'service updated successfully.',
            'status' => 200,
            'data' => $service->load('categories'),
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

            $service = service::findOrFail($id);
            $service->delete();
            return response()->json([
                'message' => 'services deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
}
