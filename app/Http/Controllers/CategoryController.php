<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {

            $Category = Category::orderBy('id','asc')->with(['service'])->get(['id','name']);
            if(!$Category)
            {
                return response()->json([
                   'message' => 'No Categorys found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Categorys retrieved successfully.',
                'status' => 200,
                'data' => $Category,
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
            "name" => "required|string|unique:categories,name",
          ]);
         
          $Category = Category::create($ValidatedData);
          if(!$Category)
          {
            throw new CustomeExceptions('Category creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'Category created successfully.',
            'status' => 201,
            'data' => $Category,
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

            $Category = Category::with(['service'])->select(['id','name'])->findOrFail($id);
            return response()->json([
                'message' => 'Categorys retrieved successfully.',
                'status' => 200,
                'data' => $Category,
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
            "name" => "sometimes|string|max:20|unique:categories,name,".$id,
         
          ]);

          $Category = Category::findOrFail($id);
          $updatedSuccess = $Category->update($ValidatedData);
          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('Category updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'Category updated successfully.',
            'status' => 200,
            'data' => $Category,
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

            $Category = Category::findOrFail($id);
            $Category->delete();
            return response()->json([
                'message' => 'Categorys deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
}
