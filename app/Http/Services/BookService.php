<?php

namespace App\Http\Services;

use App\Http\DTOs\Book\BookDto;
use App\Models\book;
use Illuminate\Http\Request;

class BookService
{
    public function StoreBookRequest(BookDto $bookDto): book
    {
        return book::create([
            'name' => $bookDto->name,
            'pages_count' => $bookDto->pages_count,
            'category_id' => $bookDto->category_id,
            'author_id' => $bookDto->author_id,
        ]);
    }

    public function UpdateBookRequest(BookDto $bookDto, book $book)
    {
        return $book->update([
            'name' => $bookDto->name,
            'pages_count' => $bookDto->pages_count,
            'category_id' => $bookDto->category_id,
            'author_id' => $bookDto->author_id,
        ]);
    }

    public function DeleteBookRequest(book $book)
    {
        $book->delete();
    }

    public function SearchBookRequest(Request $request): book
    {
        $search = $request->name;
        return book::where('name', 'like', "%$search%")->get();
    }
}
