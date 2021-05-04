<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\UserCase\Auth\Register;


use NtauhLabs\SharedService\Response;
use NtauhLabs\User\Domain\Entity\User;

final class RegisterResponse extends Response
{

    private ?User $user;

    /**
     * RegisterResponse constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = null;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function User(): ?User {
        return $this->user;
    }

}
