<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\Entity;


interface UserRepository
{
    public function addUser(User $user): void;
    public function getUserByEmail(string $email): ?User;
}
