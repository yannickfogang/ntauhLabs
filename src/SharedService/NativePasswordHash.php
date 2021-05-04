<?php


namespace NtauhLabs\SharedService;


class NativePasswordHash implements PasswordHash
{

    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isPasswordValid(string $hashedPassword, string $password): bool
    {
        return password_verify($password, $hashedPassword);
    }
}
