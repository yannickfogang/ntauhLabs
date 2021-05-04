<?php


namespace App\FrontOffice\View;


use Illuminate\Support\Facades\Auth;

class HomeView
{
    public function generateView(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
         dd(Auth::user());
         return view('front::auth.register');
    }
}
