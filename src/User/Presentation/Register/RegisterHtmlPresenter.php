<?php


namespace NtauhLabs\User\Presentation\Register;


use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterPresenter;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterResponse;

class RegisterHtmlPresenter implements RegisterPresenter
{

    /**
     * @var RegisterViewModel
     */
    private RegisterViewModel $viewModel;

    public function present(RegisterResponse $registerResponse): void
    {
        $this->viewModel         =  new RegisterViewModel();
        $this->viewModel->messages =  $registerResponse->getNotifications();
        $this->viewModel->user   =  $registerResponse->User();
    }

    /**
     * @return RegisterViewModel
     */
    public function getViewModel(): RegisterViewModel
    {
        return $this->viewModel;
    }

}
