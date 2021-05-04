<?php
use NtauhLabs\User\Presentation\Login\LoginViewModel;
/**
 * @var LoginViewModel $viewModel
 */
?>

@extends('layout.front')

@section('title') Se connecter @endsection

@section('content')

    <div class="main__content__form__page card">

        <h1>
            Se Connecter
        </h1>

        <div>
            @if(!empty($viewModel->messages))
                @foreach($viewModel->messages as $message)
                    <p>{{ $message }}</p>
                @endforeach
            @endif
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email" autocomplete="off">
                @error('email')
                <div class="alert__text alert__text__error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <input id="password"
                       type="password"
                       name="password"
                       placeholder="Mot de passe"
                       required autocomplete="new-password"
                >
                @error('password')
                <div class="alert__text alert__text__error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button class="btn__p">Se connecter</button>
            </div>

        </form>
    </div>

@endsection
