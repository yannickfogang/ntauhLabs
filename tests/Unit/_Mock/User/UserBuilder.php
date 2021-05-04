<?php

declare(strict_types=1);

namespace Tests\Unit\_Mock\User;

use NtauhLabs\User\Domain\Entity\User;
use Ramsey\Uuid\Uuid;

class UserBuilder
{
    private ?string $uuid       = null;
    private string $email       = 'fogang24@gmail.com';
    private string $username    = 'fogang24';
    private string $password    = '123456';
    private string $role        = 'member';

    public static function asUser(): UserBuilder {
        return new UserBuilder();
    }

    public function withEmail(string $email): UserBuilder
    {
        $this->email = $email;
        return $this;
    }

    public function withUserName(string $username): UserBuilder
    {
        $this->username = $username;
        return $this;
    }

    public function withPassword(string $password): UserBuilder
    {
        $this->password = $password;
        return $this;
    }

    public function withRole(string $role): UserBuilder
    {
        $this->role = $role;
        return $this;
    }

    public function withId(string $uuid): UserBuilder
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function build(): User
    {
        $uuid   =   $this->uuid ?? Uuid::uuid4()->toString();
        return new User(
            $uuid,
            $this->email,
            $this->password,
            $this->username,
            $this->role
        );
    }

}
