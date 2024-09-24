<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    public function modify(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }
}
