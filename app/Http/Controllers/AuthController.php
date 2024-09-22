<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(RegisterUserRequest $request, UserService $userService)
    {
        //Create the user
        $user = $userService->RegisterUserService($request->ToDto());
        //Generate the token for the user
        $token = $userService->CreateTokenService($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(LoginUserRequest $request, UserService $userService)
    {
        if (Auth::attempt([
            'email' => $request->ToDto()->email,
            'password' => $request->ToDto()->password
        ])) {
            $user = User::where('email', $request['email'])->first();
            $token = $userService->CreateTokenService($user);

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
