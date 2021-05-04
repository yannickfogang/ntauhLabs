<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\User\UseCase\Auth\Register;

use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterRequest;

class RegisterRequestBuilder extends RegisterRequest
{

    const   EMAIL       = 'fogang24@gmail.com';
    const   USERNAME    = 'fogang24';
    const   PASSWORD    = '123456';
    const   ROLE        = 'member';

    public static function asRegister(): RegisterRequestBuilder
    {
        return new static(self::EMAIL, self::PASSWORD, self::ROLE, self::USERNAME);
    }

    public function withEmail(string $email): RegisterRequestBuilder
    {
        $this->email    =   $email;
        return $this;
    }

    public function withUserName(string $username): RegisterRequestBuilder
    {
        $this->username =   $username;
        return $this;
    }

    public function withPassword(string $password): RegisterRequestBuilder
    {
        $this->password     =   $password;
        return $this;
    }

    public function withRole(string $role): RegisterRequestBuilder
    {
        $this->role     =   $role;
        return $this;
    }

    public function build(): RegisterRequest
    {
        return new RegisterRequest($this->email, $this->password, $this->role, $this->username);
    }

    /**
     * @return $this
     */
    public function empty(): RegisterRequestBuilder
    {
        $this->email = '';
        $this->password = '';
        $this->username = '';
        return $this;
    }


}
