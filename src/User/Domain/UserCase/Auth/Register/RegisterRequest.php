<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\UserCase\Auth\Register;


class RegisterRequest
{
    public function __construct(
       public string $email,
       public string $password,
       public string $role,
       public ?string $username = null,
    ) {

    }
}
