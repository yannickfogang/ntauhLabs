<?php


namespace NtauhLabs\SharedService;


interface PasswordHash
{
    public function hash(string $password): string;
    public function isPasswordValid(string $hashedPassword, string $password): bool;
}
