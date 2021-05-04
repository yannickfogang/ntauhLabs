<?php


namespace App\FrontOffice\View;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use NtauhLabs\User\Infrastructure\Auth;
use NtauhLabs\User\Presentation\Login\LoginHtmlPresenter;

class LoginView
{

    /**
     * @param LoginHtmlPresenter $presenter
     * @param Auth $auth
     * @return View|Factory|RedirectResponse|Application
     */
    public function generateView(LoginHtmlPresenter $presenter, Auth $auth): View|Factory|RedirectResponse|Application
    {
        if (isset($presenter->getViewModel()->messages['success'])) {
            $auth->auth($presenter->getViewModel()->user->getUuid());
            if ($presenter->getViewModel()->user->getRole() === 'admin') {
                return redirect()->route('dashboard.index')->with(['viewModel' => $presenter->getViewModel()]);
            }
            return redirect()->route('home')->with(['viewModel' => $presenter->getViewModel()]);
        }
        return view('front::auth.login', ['viewModel' => $presenter->getViewModel()]);
    }

}
