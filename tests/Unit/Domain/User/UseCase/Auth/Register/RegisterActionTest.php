<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\User\UseCase\Auth\Register;

use NtauhLabs\SharedService\NativePasswordHash;
use NtauhLabs\User\Domain\Entity\UserRepository;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterAction;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterPresenter;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterResponse;
use PHPUnit\Framework\TestCase;
use Tests\Unit\_Mock\SharedService\IdGeneratorMock;
use Tests\Unit\_Mock\User\InMemoryUserRepository;
use Tests\Unit\_Mock\User\UserBuilder;


class RegisterActionTest extends TestCase implements RegisterPresenter
{

    /**
     * @var RegisterResponse
     */
    private RegisterResponse $response;

    /**
     * @var InMemoryUserRepository|UserRepository
     */
    private UserRepository|InMemoryUserRepository $userRepository;


    /**
     * @var IdGeneratorMock
     */
    private IdGeneratorMock $idGenerator;
    /**
     * @var NativePasswordHash
     */
    private NativePasswordHash $passwordHash;
    /**
     * @var RegisterAction
     */
    private RegisterAction $registerAction;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository     =   new InMemoryUserRepository();
        $this->idGenerator        =   new IdGeneratorMock();
        $this->passwordHash       =   new NativePasswordHash();

        $this->registerAction     =   new RegisterAction(
            $this->userRepository,
            $this->idGenerator,
            $this->passwordHash,
        );
    }

    public function present(RegisterResponse $registerResponse): void
    {
        $this->response     =   $registerResponse;
    }

    public function test_is_create_user_with_hashed_password() {
        $request    =   RegisterRequestBuilder::asRegister()->build();

        $this->registerAction->execute($request, $this);
        $this->assertEquals(
             UserBuilder::asUser()
                 ->withId($this->idGenerator->getLastId())
                 ->withEmail($request->email)
                 ->withUserName($request->username)
                 ->withPassword($this->passwordHash->hash($request->password))
                 ->build()->getUuid()
            ,
            $this->userRepository->getUserByEmail($request->email)->getUuid()
        );
    }

    public function test_fails_when_email_already_exist() {
        $request    =   RegisterRequestBuilder::asRegister()->build();
        $this->userRepository->addUser(
            UserBuilder::asUser()->withEmail($request->email)->build()
        );
        $this->registerAction->execute($request, $this);

        $this->assertArrayHasKey('email', $this->response->getNotifications());
        $this->assertSame(
            'Cet adresse email est déjà utilisé',
            $this->response->getNotifications()['email']
        );

    }

}
