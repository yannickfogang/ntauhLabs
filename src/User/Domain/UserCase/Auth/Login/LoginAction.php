<?php


namespace NtauhLabs\User\Domain\UserCase\Auth\Login;


use NtauhLabs\SharedService\PasswordHash;
use NtauhLabs\User\Domain\Entity\User;
use NtauhLabs\User\Domain\Entity\UserRepository;

class LoginAction
{

    private UserRepository $userRepository;
    private PasswordHash $passwordHash;

    public function __construct(UserRepository $userRepository, PasswordHash $passwordHash) {

        $this->userRepository = $userRepository;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @param LoginRequest $request
     * @param LoginPresenter $presenter
     */
    public function execute(LoginRequest $request, LoginPresenter $presenter) {
        $user       =   $this->userRepository->getUserByEmail($request->email);
        $response   =   new LoginResponse();
        $user       =   $this->checkAccountExist($user, $response);
        if ($user) {
            $user   =   $this->checkPasswordIsValid($user, $response, $request->password);
        }
        if ($user) {
            $response->setUser($user);
            $response->setNotification('success','logged');
        }
        $presenter->present($response);
    }

    /**
     * @param $user
     * @param LoginResponse $response
     * @return User|null
     */
    private function checkAccountExist($user, LoginResponse $response): ?User
    {
        if(!$user) {
            $response->setNotification('not_exist', 'Ce compte n\'existe pas');
            return null;
        }
        return $user;
    }

    /**
     * @param User $user
     * @param LoginResponse $response
     * @param string $password
     * @return User|null
     */
    private function checkPasswordIsValid(User $user, LoginResponse $response, string $password): ?User
    {
        if (!$this->passwordHash->isPasswordValid($user->getPassword(), $password)) {
            $response->setNotification('wrong_password', 'Votre mot de passe est invalide');
            return null;
        }
        return $user;
    }
}
