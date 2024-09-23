<?php

namespace App\Http\DTOs\Author;

use Spatie\LaravelData\Data;

class StoreAuthorDto extends Data
{
    public function __construct(
        public string $name,
        public string $bio,
        public string $email,
        public string $image
    ) {}
}
