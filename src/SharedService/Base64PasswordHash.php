<?php


namespace NtauhLabs\SharedService;


class Base64PasswordHash  implements PasswordHash
{

    public function __construct()
    {
    }

    public function hash(string $password): string
    {
        return base64_decode($password);
    }

    public function isPasswordValid(string $hashedPassword, string $password): bool
    {
        return base64_decode($hashedPassword) === $password;
    }
}
