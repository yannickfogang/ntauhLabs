<?php


namespace NtauhLabs\User\Presentation\Register;


use NtauhLabs\User\Domain\Entity\User;

class RegisterViewModel
{
    public array $messages = [];
    public ?User $user;
}
