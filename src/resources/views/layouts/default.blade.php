<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お問い合わせフォーム')</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- フォント変更 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body class="@yield('body-class')">
    <header>
        <h1>FashionablyLate</h1>

        <!-- 登録ページでログインボタン -->
        @if(request()->is('register'))
            <a href="{{ route('login') }}" class="login-link">login</a>
        <!-- ログインページで登録ボタン -->
        @elseif(request()->is('login'))
            <a href="{{ route('register') }}" class="login-link">register</a>
        @endif

    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
