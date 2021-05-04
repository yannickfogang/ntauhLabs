<?php


namespace App\FrontOffice\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest  extends FormRequest
{

    public function messages()
    {
        return [
            'email.required'    =>  'Veuillez renseigner votre adresse email',
            'email.email'       =>  'Cet adresse email n\'est pas valide',
            'email.unique'      =>  'Cet adresse email est déjà utilisé',
            'password.required' =>  'Veuillez renseigner votre mot de passe',
            'password.min'      =>  'Votre mot de passe doit contenir au moins 4 caractères',
            'password_confirmation.same' => 'La confirmation de votre mot de passe n\'est pas valide',
            'password_confirmation.required' => 'Veuillez renseigner la confirmation de votre mot de passe',
            'password_confirmation.min' => 'Votre mot de passe doit contenir au moins 4 caractères',
        ];
    }

    public function rules() {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|min:4|same:password'
        ];
    }
}

