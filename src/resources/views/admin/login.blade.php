@extends('layouts.default')

@section('body-class', 'register-page')

@section('title', 'Login')

@section('content')
<div class="register-content">
    <h2 class="register-title">Login</h2>
    <div class="register-card">
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <!-- メールアドレス -->
            <div class="register-group">
                <label class="register-label" for="email">メールアドレス</label>
                <input type="email" id="email" name="email" class="register-input"
                       value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email')
                    <div class="register-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- パスワード -->
            <div class="register-group">
                <label class="register-label" for="password">パスワード</label>
                <input type="password" id="password" name="password" class="register-input"
                       placeholder="例: coachtech1106">
                @error('password')
                    <div class="register-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="register-btn">ログイン</button>
        </form>
    </div>
</div>
@endsection
