<?php

namespace App\Http\Services;

use App\Http\DTOs\User\RegisterUserDto;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function registerUserService(RegisterUserDto $registerUserDto): User
    {
        $user = User::create([
            'name' => $registerUserDto->name,
            'email' => $registerUserDto->email,
            'password' => $registerUserDto->password,
        ]);
        $user->assignRole('user');

        return $user;
    }

    public function createTokenService(User $user): string
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
