<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Services\AuthorService;
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
    public function store(StoreAuthorRequest $request, AuthorService $authorService)
    {
        $author = $authorService->StoreAuthorService($request);
        return $author;
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
    public function update(UpdateAuthorRequest $request, author $author, AuthorService $authorService)
    {
        $authorService->UpdateAuthorService($request, $author);
        return $author;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author, AuthorService $authorService)
    {
        $authorService->DeleteAuthorService($author);
        return response()->json([
            'message' => 'author deleted'
        ]);
    }
}
