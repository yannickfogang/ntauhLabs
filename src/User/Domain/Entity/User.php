<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\Entity;


class User
{
    private string $uuid;
    private string $email;
    private ?string $password;
    private ?string $username;
    private ?string $role;

    public function __construct(string $uuid, string $email, ?string $password, ?string $username, ?string $role) {
        $this->uuid     =   $uuid;
        $this->email    =   $email;
        $this->password =   $password;
        $this->username =   $username;
        $this->role     =   $role;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

}
