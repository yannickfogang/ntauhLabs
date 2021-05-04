<?php

namespace NtauhLabs\User\Infrastructure;

use NtauhLabs\User\Domain\UserCase\Auth\Authentificated;
use NtauhLabs\User\Infrastructure\Models\User;

class Auth implements Authentificated
{

    public function auth(string $uuid): void
    {
        $user   =   User::where(['uuid' => $uuid])->first();
        \Illuminate\Support\Facades\Auth::login($user);
    }

}

