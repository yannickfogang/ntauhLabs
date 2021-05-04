<?php


namespace App\FrontOffice\View;


use NtauhLabs\User\Presentation\Register\RegisterHtmlPresenter;

class RegisterView
{

    public function __construct() {}

    /**
     * @param RegisterHtmlPresenter $presenter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generateView(RegisterHtmlPresenter $presenter): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('front::home.index', ['viewModel' => $presenter->getViewModel()]);
    }

}
