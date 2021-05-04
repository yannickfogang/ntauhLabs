<?php


namespace NtauhLabs\User\Builder;


use JetBrains\PhpStorm\Pure;
use NtauhLabs\User\Domain\Entity\User;
use Ramsey\Uuid\Uuid;

class UserBuilder
{

    private string $uuid;
    private string $email;
    private ?string $password = null;
    private ?string $username = null;
    private ?string $role = 'member';

    #[Pure]
    public static function asUser(): UserBuilder
    {
        return new UserBuilder();
    }

    public function withEmail(string $email): UserBuilder
    {
        $this->email = $email;
        return $this;
    }

    public function withUserName(?string $username): UserBuilder
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
