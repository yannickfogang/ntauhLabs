<?php


namespace App\FrontOffice\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController
{

    public function __invoke(): Factory|View|Application
    {
        return view('front::home.index');
    }
}
