<?php


namespace NtauhLabs\User\Presentation\Login;


use NtauhLabs\User\Domain\Entity\User;

class LoginViewModel
{
    public array $messages = [];
    public ?User $user;
}
