<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $vaildator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $user->assignRole('user');
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(Request $request)
    {
        $vaildator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);

        if ($vaildator->fails()) {
            return response()->json(
                [
                    'error' => $vaildator->messages()
                ],
                422
            );
        }

        $user = User::where('email', $request['email'])->first();

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token
            ];
        } else {
            return response([
                'message' => 'bad information'
            ], 401);
        }
    }
}
