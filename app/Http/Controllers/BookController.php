<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Http\Services\BookService;
use App\Models\Book;
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
        $books = Book::with(['categories', 'authors'])->get();
        return $books;
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(BookRequest $request, BookService $bookService)
    {
        $book = $bookService->storeBookRequest($request->toDto());

        return $book;
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return $book->load('categories', 'authors');
    }

    /**
     * Update the specified book in storage.
     */
    public function update(BookRequest $request, Book $book, BookService $bookService)
    {
        $bookService->updateBookRequest($request->toDto(), $book);
        return $book;
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book, BookService $bookService)
    {
        $bookService->deleteBookRequest($book);
        return response()->json([
            'message' => 'Book deleted'
        ]);
    }

    /**
     * Search for the specified book from storage.
     */
    public function search(Request $request, BookService $bookService)
    {
        $result = $bookService->searchBookRequest($request);
        return $result;
    }
}
