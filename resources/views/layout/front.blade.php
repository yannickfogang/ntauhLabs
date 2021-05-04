<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body>

<main>


    <nav class="header__nav">
        <ul class="header__nav__left">
            <li><a href="#">Tutoriels</a></li>
            <li><a href="">Cours</a></li>
            <li><a href="">Blog</a></li>
        </ul>
        <ul class="header__nav__right">
            <!--form action="#">
                <input type="text" placeholder="search" name="search">
            </form-->
            @auth
                <li><a href="{{ route('logout') }}">Se deconnecter</a></li>
            @endauth
            @guest
                <li><a href="{{ route('login') }}">Se connecter</a></li>
                <li><a href="{{ route('register') }}">S'inscrire</a></li>
            @endguest
        </ul>
    </nav>


    <div class="header__sub">
        <ul class="header__sub__ul">
            <li>#php</li>
            <li>#javascript</li>
            <li>#python</li>
            <li>#go</li>
            <li>#html/css</li>
            <li>#algorithme</li>
            <li>#base de donnée</li>
        </ul>
    </div>


    <div class="main__content">

        @yield('content')

    </div>

    <div>
        <!-- He who is contented is rich. - Laozi -->
    </div>

</main>


</body>
</html>
