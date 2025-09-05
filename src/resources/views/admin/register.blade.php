@extends('layouts.default')

@section('body-class', 'register-page')

@section('title', 'Register')

@section('content')

<div class="register-content">
    <h2 class="register-title">Register</h2>
    <div class="register-card">
        <!-- メール形式エラー表示のためにnovalidate -->
        <form method="POST" action="{{ route('register.store') }}" novalidate>
            @csrf

            <!-- お名前 -->
            <div class="register-group">
                <label class="register-label" for="name">お名前</label>
                <input type="text" id="name" name="name" class="register-input"
                       value="{{ old('name') }}" placeholder="例: 山田 太郎">
                @error('name')
                    <div class="register-error">{{ $message }}</div>
                @enderror
            </div>

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

            <button type="submit" class="register-btn">登録</button>
        </form>
    </div>
</div>
@endsection
