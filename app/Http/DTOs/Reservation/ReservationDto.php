<?php

namespace App\Http\DTOs\Reservation;

use Spatie\LaravelData\Data;

class ReservationDto extends Data
{
    public function __construct(
        public string $length,
        public int $book_id,
    ) {}
}
