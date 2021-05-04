<?php

namespace App\FrontOffice\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController
{

    public function __invoke(): RedirectResponse
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('home');
    }
}
