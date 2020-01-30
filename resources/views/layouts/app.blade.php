<!DOCTYPE html>
<html lang="en">

<head>
    <title>Химия</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app.css') }}">
    <meta name="description" content="Пусть между вами будет химия.">
    <meta name="keywords" content="химия, поиск, арт-директор, копирайтер">
</head>
<body>

    <div class="header">
        <a href="https://chmstr.ru" class="typo header__logo">Химия</a>
    </div>

    @if (Session::has('id'))
        <div class="nav">
            <a class="nav__item nav__item_search" href="{{ route('main.index') }}" title="Поиск"></a>
            <a class="nav__item nav__item_profile" href="{{ route('main.settings') }}"  title="Настройки"></a>
            <a class="nav__item nav__item_more" href="{{ route('welcome.about') }}"  title="О приложении"></a>
        </div>
    @endif

    @yield('content')

    @yield('jscontent')

</body>

</html>
