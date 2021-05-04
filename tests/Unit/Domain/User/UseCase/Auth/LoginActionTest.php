<?php


namespace Domain\User\UseCase\Auth;


use NtauhLabs\SharedService\NativePasswordHash;
use NtauhLabs\User\Domain\Entity\User;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginAction;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginPresenter;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginRequest;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginResponse;
use PHPUnit\Framework\TestCase;
use Tests\Unit\_Mock\User\InMemoryUserRepository;
use Tests\Unit\_Mock\User\UserBuilder;


class LoginActionTest extends TestCase implements LoginPresenter
{
    const PASSWORD = '123456';

    private NativePasswordHash $passwordHash;
    private User $registeredUser;
    private InMemoryUserRepository $userRepository;
    private LoginAction $loginAction;
    private LoginResponse $response;

    public function setUp(): void
    {
        parent::setUp();
        $this->passwordHash         =   new NativePasswordHash();
        $this->userRepository       =   new InMemoryUserRepository();
        $this->registeredUser       =   UserBuilder::asUser()->withEmail('fogang24@gmail.com')
                                                             ->withPassword($this->passwordHash->hash(self::PASSWORD))
                                                             ->build();
        $this->loginAction          =   new LoginAction($this->userRepository, $this->passwordHash);
    }

    public function present(LoginResponse $response): void
    {
        $this->response     =   $response;
    }

    public function test_user_login_with_valid_credential() {
        $this->userRepository->addUser($this->registeredUser);
        $this->loginAction->execute(new LoginRequest($this->registeredUser->getEmail(), self::PASSWORD), $this);
        $this->assertNotNull($this->response->User());
        $this->assertSame($this->registeredUser->getEmail(), $this->response->User()->getEmail());
        $this->assertSame($this->registeredUser->getUsername(), $this->response->User()->getUsername());
    }

    public function test_user_login_with_wrong_email() {
        $this->userRepository->addUser($this->registeredUser);
        $this->loginAction->execute(new LoginRequest('test@gmail.com', self::PASSWORD), $this);
        $this->assertNull($this->response->User());
        $this->assertArrayHasKey('not_exist', $this->response->getNotifications());
    }

    public function test_user_login_with_wrong_password() {
        $this->userRepository->addUser($this->registeredUser);
        $this->loginAction->execute(new LoginRequest($this->registeredUser->getEmail(), '5698745'), $this);
        $this->assertNull($this->response->User());
        $this->assertArrayHasKey('wrong_password', $this->response->getNotifications());
    }

}
