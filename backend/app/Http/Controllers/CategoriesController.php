<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categories::get();
        return response()->json([
            'message' => 'Successful',
            'data' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $category = Categories::find($id);
        if (isset($category)) {
            $videos = $category->videos;
            if($videos->count() > 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successful',
                    'data' => $videos 
                ], 200);
            }
            return response()->json(['success' => false, 'message' => $category->category_name . "is doesn't have any videos yet."], 404);
        }
        return response()->json(['success' => false, 'message' => "Category not found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
