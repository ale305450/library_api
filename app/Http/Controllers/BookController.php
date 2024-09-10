<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\search;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = book::with(['categories', 'authors'])->get();
        return $books;
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $vaildator = Validator::make($request->all(), [
            'name' => ['required'],
            'pages_count' => ['required', 'min_digits:2'],
            'category_id' => ['required'],
            'author_id' => ['required'],
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }

        return book::create([
            'name' => $request->name,
            'pages_count' => $request->pages_count,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
        ]);
    }

    /**
     * Display the specified book.
     */
    public function show(book $book)
    {
        return $book->load('categories', 'authors');
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, book $book)
    {
        $vaildator = Validator::make($request->all(), [
            'name' => ['required'],
            'pages_count' => ['required', 'min_digits:2'],
            'category_id' => ['required'],
            'author_id' => ['required'],
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }

        return $book->update([
            'name' => $request->name,
            'pages_count' => $request->pages_count,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
        ]);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(book $book)
    {
        return $book->delete();
    }

    /**
     * Search for the specified book from storage.
     */
    public function search(Request $request)
    {
        $search = $request->name;
        $result = book::where('name', 'like', "%$search%")->get();
        return $result;
    }
}
