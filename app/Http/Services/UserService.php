<?php

namespace App\Http\Services;

use App\Http\DTOs\User\RegisterUserDto;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function RegisterUserService(RegisterUserDto $registerUserDto): User
    {
        $user = User::create([
            'name' => $registerUserDto->name,
            'email' => $registerUserDto->email,
            'password' => $registerUserDto->password,
        ]);
        $user->assignRole('user');

        return $user;
    }

    public function CreateTokenService(User $user): string
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
