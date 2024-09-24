<?php

namespace App\Http\Services;

use App\Http\DTOs\Book\BookDto;
use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function storeBookRequest(BookDto $bookDto): Book
    {
        return Book::create([
            'name' => $bookDto->name,
            'pages_count' => $bookDto->pages_count,
            'category_id' => $bookDto->category_id,
            'author_id' => $bookDto->author_id,
        ]);
    }

    public function updateBookRequest(BookDto $bookDto, Book $book)
    {
        return $book->update([
            'name' => $bookDto->name,
            'pages_count' => $bookDto->pages_count,
            'category_id' => $bookDto->category_id,
            'author_id' => $bookDto->author_id,
        ]);
    }

    public function deleteBookRequest(Book $book)
    {
        $book->delete();
    }

    public function searchBookRequest(Request $request): book
    {
        $search = $request->name;
        return book::where('name', 'like', "%$search%")->get();
    }
}
