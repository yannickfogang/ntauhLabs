@extends('layout.front')

@section('title') Créer son compte @endsection

@section('content')

    <div class="main__content__form__page card">

        <h1>
            S'inscrire
        </h1>

        <form method="POST" action="{{ route('register') }}">
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
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation" placeholder="Confirmer votre mot de passe" required
                >
                @error('password_confirmation')
                <div class="alert__text alert__text__error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button class="btn__p">S'inscrire</button>
            </div>

        </form>
    </div>

@endsection
