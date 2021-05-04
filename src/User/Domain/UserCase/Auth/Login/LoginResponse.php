<?php


namespace NtauhLabs\User\Domain\UserCase\Auth\Login;


use NtauhLabs\SharedService\Response;
use NtauhLabs\User\Domain\Entity\User;

final class LoginResponse extends Response
{
    private ?User $user;
    private ?\NtauhLabs\User\Infrastructure\Models\User $userModel;

    public function __construct() {
        parent::__construct();
        $this->user = null;
        $this->userModel = null;
    }

    public function User(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function setModelUser(\NtauhLabs\User\Infrastructure\Models\User $user) {
        $this->userModel = $user;
    }

    public function userModel(): ?\NtauhLabs\User\Infrastructure\Models\User
    {
        return $this->userModel;
    }
}
