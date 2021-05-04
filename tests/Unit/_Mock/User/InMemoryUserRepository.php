<?php

declare(strict_types=1);

namespace Tests\Unit\_Mock\User;


use NtauhLabs\User\Domain\Entity\User;
use NtauhLabs\User\Domain\Entity\UserRepository;

class InMemoryUserRepository implements UserRepository
{

    private array $users = [];

    /**
     * InMemoryUserRepository constructor.
     */
    public function __construct()
    {
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        if ($this->isEmpty()) {
            return null;
        }
        $users  =   array_filter($this->users, static function($user) use ($email) {
            return $user->getEmail() === $email;
        });
        if(empty($users)) {
            return null;
        }
        if ($users[0]->getEmail() !== $email) {
            return null;
        }
        return $users[0];
    }

    public function isEmpty(): bool
    {
        return count($this->users) === 0;
    }
}
