<?php

declare(strict_types=1);

namespace NtauhLabs\User\Domain\UserCase\Auth\Register;

use NtauhLabs\SharedService\IdGenerator;
use NtauhLabs\SharedService\PasswordHash;
use NtauhLabs\User\Builder\UserBuilder;
use NtauhLabs\User\Domain\Entity\User;
use NtauhLabs\User\Domain\Entity\UserRepository;


final class RegisterAction
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var IdGenerator
     */
    private IdGenerator $idGenerator;
    /**
     * @var PasswordHash
     */
    private PasswordHash $passwordHash;

    /**
     * RegisterAction constructor.
     * @param UserRepository $userRepository
     * @param IdGenerator $idGenerator
     * @param PasswordHash $passwordHash
     */
    public function __construct(
        UserRepository  $userRepository,
        IdGenerator $idGenerator,
        PasswordHash $passwordHash
    )
    {
        $this->userRepository = $userRepository;
        $this->idGenerator = $idGenerator;
        $this->passwordHash = $passwordHash;
    }

    public function execute(RegisterRequest $registerRequest, RegisterPresenter $presenter)
    {

        $registerResponse   =   new RegisterResponse();

        $user   =   UserBuilder::asUser()
                        ->withId($this->idGenerator->generate())
                        ->withEmail($registerRequest->email)
                        ->withPassword($this->passwordHash->hash($registerRequest->password))
                        ->withUserName($registerRequest->username)
                        ->build();

        $isValid      =   $this->verifyIfEmailIsAlreadyTaken($registerRequest->email, $registerResponse);

        if ($isValid) {
            $this->saveUser($user);
            $registerResponse->setUser($user);
            $registerResponse->setNotification('success', 'Un email de validation vous été envoyé par mail');
        } else {
            $registerResponse->setNotification('error', 'Une erreur est survenue lors de la création de votre compte');
        }

        $presenter->present($registerResponse);
    }

    private function saveUser(User $user) {
        $this->userRepository->addUser($user);
    }

    private function verifyIfEmailIsAlreadyTaken(string $email, RegisterResponse  $registerResponse): bool
    {
        $user   =   $this->userRepository->getUserByEmail($email);
        if (!$user) {
            return true;
        }
        $registerResponse->setNotification('email', 'Cet adresse email est déjà utilisé');
        return false;
    }

}
