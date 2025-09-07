<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お問い合わせフォーム')</title>

    <!-- CSS読み込み -->
    <!-- 共通スタイル -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- トップページ用 -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- 確認ページ用 -->
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <!-- ありがとうページ用 -->
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <!-- 登録ページ用 -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <!-- ダッシュボード管理画面用 -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Google Fonts設定 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body class="@yield('body-class')">
    <header>
        <h1>FashionablyLate</h1>

        <!-- ページごとのボタン切り替え -->
        <!-- 登録ページではログインボタンを表示 -->
        @if(request()->is('register'))
            <a href="{{ route('login') }}" class="login-link">login</a>

        <!-- ログインページでは登録ボタンを表示 -->
        @elseif(request()->is('login'))
            <a href="{{ route('register') }}" class="login-link">register</a>

        <!-- 管理画面ではログアウトボタンを表示 -->
        @elseif(request()->is('admin*'))
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-link">logout</button>
            </form>
        @endif
    </header>

    <!-- メインコンテンツ挿入箇所 -->
    <main>
        @yield('content')
    </main>

</body>
</html>
