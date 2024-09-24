<?php

namespace App\Http\Services;

use App\Http\DTOs\Reservation\ReservationDto;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReservationService
{
    public function userReservationsService(): Collection
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        return $reservations;
    }

    public function makeReservationsService(ReservationDto $reservationDto): Reservation
    {
        //get current user
        $user = Auth::user();

        return Reservation::create([
            'length' => $reservationDto->length,
            'book_id' => $reservationDto->book_id,
            'user_id' => $user->id,
        ]);
    }

    public function cancelReservationsService(Reservation $reservation)
    {
        //get current user
        Gate::authorize('modify', $reservation);
        $reservation->delete();
    }
}
