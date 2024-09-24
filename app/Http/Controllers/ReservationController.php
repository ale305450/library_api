<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\ReservationRequest;
use App\Http\Services\ReservationService;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function userReservations(ReservationService $reservationService)
    {
        $reservations = $reservationService->userReservationsService();
        return response()->json($reservations);
    }

    public function makeReservations(ReservationRequest $request, ReservationService $reservationService)
    {
        $reservation = $reservationService->makeReservationsService($request->toDto());
        return $reservation;
    }

    public function cancelReservations(Reservation $reservation, ReservationService $reservationService)
    {
        $reservationService->cancelReservationsService($reservation);
        return response()->json(['message' => 'you canceld your reservation']);
    }
}
