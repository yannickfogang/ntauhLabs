<?php


namespace NtauhLabs\User\Domain\UserCase\Auth\Login;


interface LoginPresenter
{
    public function present(LoginResponse $response): void;
}
