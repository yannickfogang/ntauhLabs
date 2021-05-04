<?php


namespace App\FrontOffice\Http\Controllers\Auth;


use App\FrontOffice\Http\Requests\RegisterFormRequest;
use App\FrontOffice\View\RegisterView;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterAction;
use NtauhLabs\User\Domain\UserCase\Auth\Register\RegisterRequest;
use NtauhLabs\User\Presentation\Register\RegisterHtmlPresenter;

class RegisterController
{

    /**
     * @return Factory|View|Application
     */
    public function register(): Factory|View|Application
    {
        return view('front::auth.register');
    }

    /**
     * @param RegisterFormRequest $requestForm
     * @param RegisterAction $registerAction
     * @param RegisterHtmlPresenter $presenter
     * @return Factory|View|Application
     */
    public function saveUser(RegisterFormRequest $requestForm, RegisterView $view, RegisterAction $registerAction, RegisterHtmlPresenter $presenter): Factory|View|Application
    {
        $request            =   new RegisterRequest($requestForm->get('email'), $requestForm->get('password'), 'member');
        $registerAction->execute($request, $presenter);
        return $view->generateView($presenter);
    }

}
