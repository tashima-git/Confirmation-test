@extends('layouts.default')

@section('title', 'お問い合わせ入力')

@section('content')

<h2>Contact</h2>

<form action="{{ url('/confirm') }}" method="post" class="contact-form">
    @csrf

    <!-- お名前（姓・名2つ） -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">お名前</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" class="contact-form__input">
        <input type="text" name="first_name" value="{{ old('first_name') }}" class="contact-form__input">
    </div>

<!-- 性別 -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">性別</label>
        <div>
            <label class="radio-label">
                <input type="radio" name="gender" value="1" {{ old('gender',1)==1?'checked':'' }}>
                <span>男性</span>
            </label>
            <label class="radio-label">
                <input type="radio" name="gender" value="2" {{ old('gender')==2?'checked':'' }}>
                <span>女性</span>
            </label>
            <label class="radio-label">
                <input type="radio" name="gender" value="3" {{ old('gender')==3?'checked':'' }}>
                <span>その他</span>
            </label>
        </div>
    </div>




    <!-- メールアドレス -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="contact-form__input">
    </div>

    <!-- 電話番号 -->
    <div class="contact-form__item contact-form__item--tel">
        <label class="contact-form__label contact-form__label--required">電話番号</label>
        <input type="text" name="tel1" value="{{ old('tel1') }}">
        <span class="tel-divider">-</span>
        <input type="text" name="tel2" value="{{ old('tel2') }}">
        <span class="tel-divider">-</span>
        <input type="text" name="tel3" value="{{ old('tel3') }}">
    </div>

    <!-- 住所 -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">住所</label>
        <input type="text" name="address" value="{{ old('address') }}" class="contact-form__input">
    </div>

    <!-- 建物名（任意） -->
    <div class="contact-form__item">
        <label class="contact-form__label">建物名</label>
        <input type="text" name="building" value="{{ old('building') }}" class="contact-form__input">
    </div>

    <!-- お問い合わせの種類 -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">お問い合わせの種類</label>
        <div class="contact-form__select-wrapper">
            <select name="category_id" class="contact-form__select">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
    </div>


    <!-- お問い合わせ内容 -->
    <div class="contact-form__item contact-form__item--textarea">
        <label class="contact-form__label contact-form__label--required">お問い合わせ内容</label>
        <textarea name="detail" rows="5" class="contact-form__textarea">{{ old('detail') }}</textarea>
    </div>


    <!-- 送信ボタン -->
    <div class="contact-form__item contact-form__item--button">
        <button type="submit" class="contact-form__button">確認画面</button>
    </div>


</form>
@endsection
