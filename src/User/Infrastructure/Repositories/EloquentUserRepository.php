<?php

namespace NtauhLabs\User\Infrastructure\Repositories;

use NtauhLabs\User\Builder\UserBuilder;
use NtauhLabs\User\Domain\Entity\User;
use NtauhLabs\User\Domain\Entity\UserRepository;
use NtauhLabs\User\Infrastructure\Models\User as UserModel;

class EloquentUserRepository implements UserRepository
{

    public function addUser(User $user): void
    {
        try {
            UserModel::create(
                [
                    'uuid'          =>  $user->getUuid(),
                    'password'      =>  $user->getPassword(),
                    'email'         =>  $user->getEmail(),
                    'username'      =>  $user->getUsername()
                ]
            );
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        $user  =   UserModel::where(['email' => $email])->first();
        if (!$user) {
            return null;
        }
        return UserBuilder::asUser()
            ->withId($user->uuid)
            ->withEmail($user->email)
            ->withUserName($user->username)
            ->withPassword($user->password)
            ->withRole($user->role)
            ->build();
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getUserModelById(string $uuid): mixed
    {
        return UserModel::where(['uuid' => $uuid])->first();
    }

}
