<?php

namespace App\Http\DTOs\Book;

use Brick\Math\BigInteger;
use Spatie\LaravelData\Data;

class BookDto extends Data
{
    public function __construct(
        public string $name,
        public int $pages_count,
        public int $category_id,
        public int $author_id
    ) {}
}
