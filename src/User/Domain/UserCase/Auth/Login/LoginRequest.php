<?php


namespace NtauhLabs\User\Domain\UserCase\Auth\Login;


class LoginRequest
{
    public string $email;
    public string $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }
}
