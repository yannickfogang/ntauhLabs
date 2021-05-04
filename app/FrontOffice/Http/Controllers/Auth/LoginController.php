<?php

namespace App\FrontOffice\Http\Controllers\Auth;

use App\FrontOffice\Http\Requests\LoginFormRequest;
use App\FrontOffice\View\LoginView;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use NtauhLabs\User\Infrastructure\Auth;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginAction;
use NtauhLabs\User\Domain\UserCase\Auth\Login\LoginRequest;
use NtauhLabs\User\Presentation\Login\LoginHtmlPresenter;

class LoginController
{

    /**
     * @param LoginView $view
     * @param LoginHtmlPresenter $presenter
     * @return Application|Factory|View
     */
    public function login(
        LoginView $view,
        LoginHtmlPresenter $presenter,
        Auth $auth
    ): View|Factory|Application
    {
        return $view->generateView($presenter, $auth);
    }


    /**
     * @param LoginFormRequest $request
     * @param LoginHtmlPresenter $presenter
     * @param LoginView $view
     * @param LoginAction $loginAction
     * @return Factory|View|Application|RedirectResponse
     */
    public function saveLogin(
        LoginFormRequest $request,
        LoginHtmlPresenter $presenter,
        LoginView $view,
        LoginAction $loginAction,
        Auth $auth
    ): Factory|View|Application|RedirectResponse
    {
        $loginRequest   =   new LoginRequest($request->get('email'), $request->get('password'));
        $loginAction->execute($loginRequest, $presenter);
        return $view->generateView($presenter, $auth);
    }

}
