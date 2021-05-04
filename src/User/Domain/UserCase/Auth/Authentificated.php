<?php


namespace NtauhLabs\User\Domain\UserCase\Auth;


interface Authentificated
{
    public function auth(string $uuid): void;
}
