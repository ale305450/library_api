<?php

namespace App\Http\DTOs\Category;

use Spatie\LaravelData\Data;

class CategoryDto extends Data
{
    public function __construct(
        public string $name,
    ) {}
}
