<?php

namespace App\Http\DTOs\Author;

use Spatie\LaravelData\Data;

class UpdateAuthorDto extends Data
{
    public function __construct(
        public string $name,
        public string $bio,
        public string $image
    ) {}
}
