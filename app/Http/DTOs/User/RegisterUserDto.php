<?php

namespace App\Http\DTOs\User;

use Spatie\LaravelData\Data;

class RegisterUserDto extends Data
{
    public function __construct(public string $name, public string $email, public string $password) {}
}
