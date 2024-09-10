<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        return category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaildator = Validator::make(
            $request->all(),
            ['name' => ['required','unique:categories']]
        );
        if ($vaildator->fails()) {
            return response()->json(
                ['error' => $vaildator->messages()],
                422
            );
        }

        return category::create(['name' => $request->name]);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $vaildator = Validator::make(
            $request->all(),
            ['name' => ['required','unique:categories']]
        );
        if ($vaildator->fails()) {
            return response()->json(
                ['error' => $vaildator->messages()],
                422
            );
        }

        return $category->update([
            'name' => $request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        return $category->delete();
        return response()->json([
            'message' => 'category deleted'
        ]);
    }
}
