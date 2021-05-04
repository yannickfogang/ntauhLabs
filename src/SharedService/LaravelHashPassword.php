<?php


namespace NtauhLabs\SharedService;


use Illuminate\Support\Facades\Hash;

class LaravelHashPassword implements PasswordHash
{

    public function hash(string $password): string
    {
        return Hash::make($password);
    }

    public function isPasswordValid(string $hashedPassword, string $password): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
