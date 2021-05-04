<?php


namespace NtauhLabs\User\Presentation\Login;


use JetBrains\PhpStorm\Pure;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginPresenter;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginResponse;

class LoginHtmlPresenter implements LoginPresenter
{
    private LoginViewModel $viewModel;

    #[Pure] public function __construct() {
        $this->viewModel   =   new LoginViewModel();
    }

    public function present(LoginResponse $response): void
    {
        $this->viewModel->user        =   $response->User();
        $this->viewModel->messages    =   $response->getNotifications();

    }

    public function getViewModel(): LoginViewModel
    {
        return  $this->viewModel;
    }
}
