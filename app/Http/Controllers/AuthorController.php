<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        return author::all();
    }

    /**
     * Store a newly created author in db.
     */
    public function store(Request $request)
    {
        $vaildator = Validator::make($request->all(), [
            'name' => ['required'],
            'bio' => ['required'],
            'email' => ['required', 'email', 'unique:authors'],
            'image' => ['file', 'mimes:png,jpg'],
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images', $request->image);
        }

        return author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'email' => $request->email,
            'image' => $path
        ]);
    }

    /**
     * Display the specified author.
     */
    public function show(author $author)
    {
        $author = author::find($author);
        if ($author == null) {
            return response()->json(['error' => 'no author can be found']);
        }
        return $author;
        //return 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        $vaildator = Validator::make($request->all(), [
            'name' => ['required'],
            'bio' => ['required'],
            'email' => ['required', 'email'],
            'image' => ['file', 'mimes:png,jpg'],
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }
        $path =  $author->image ?? null;
        if ($request->hasFile('image')) {
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $path = Storage::disk('public')->put('/images', $request->image);
        }

        return $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'email' => $request->email,
            'image' => $path
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        //
        Storage::disk('public')->delete($author->image);
        $author->delete();
        return response()->json([
            'message' => 'author deleted'
        ]);
    }
}
