<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Http\Services\BookService;
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
    public function store(BookRequest $request, BookService $bookService)
    {
        $book = $bookService->StoreBookRequest($request->ToDto());

        return $book;
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
    public function update(BookRequest $request, book $book, BookService $bookService)
    {
        $bookService->UpdateBookRequest($request->ToDto(), $book);
        return $book;
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(book $book, BookService $bookService)
    {
        $bookService->DeleteBookRequest($book);
        return response()->json([
            'message' => 'Book deleted'
        ]);
    }

    /**
     * Search for the specified book from storage.
     */
    public function search(Request $request, BookService $bookService)
    {
        $result = $bookService->SearchBookRequest($request);
        return $result;
    }
}
