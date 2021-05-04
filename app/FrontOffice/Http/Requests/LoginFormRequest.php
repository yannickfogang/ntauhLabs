<?php


namespace App\FrontOffice\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest  extends FormRequest
{

    public function messages()
    {
        return [
            'email.required'    =>  'Veuillez renseigner votre adresse email',
            'email.email'       =>  'votre adresse email n\'est pas valide',
            'password.required' =>  'Veuillez renseigner votre mot de passe'
        ];
    }

    public function rules() {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:4'
        ];
    }
}

