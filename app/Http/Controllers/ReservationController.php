<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function userReservations()
    {
        $user = Auth::user();
        $reservayions = reservation::where('user_id', '==', "$user->id")->get();
        return $reservayions;
    }

    public function makeReservations(Request $request)
    {
        $vaildator = Validator::make($request->all(), [
            'length' => ['required'],
            'book_id' => ['required', 'unique:reservations'],
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }
        //get current user
        $user = Auth::user();

        return reservation::create([
            'length' => $request->length,
            'book_id' => $request->book_id,
            'user_id' => $user->id,
        ]);
    }

    public function cancelReservations(reservation $reservation)
    {
        //get current user
        $user = Auth::user();
        if ($reservation->user_id == $user->id) {
            $reservation->delete();
            return response()->json(['message' => 'you canceld your reservation']);
        } else {
            return response()->json(['message' => 'you cannot cancel the reservation']);
        }
    }
}
