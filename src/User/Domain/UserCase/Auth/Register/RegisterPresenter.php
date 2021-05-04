<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\UserCase\Auth\Register;


interface RegisterPresenter
{
    public function present(RegisterResponse $registerResponse): void;
}
