@extends('layouts.default')

@section('title', 'お問い合わせ入力')

@section('content')

<h2>Contact</h2>

<!-- フォーム：確認ページへ送信 -->
<!-- novalidate：ブラウザのデフォルトバリデーションを無効化 -->
<form action="{{ url('/confirm') }}" method="post" class="contact-form" novalidate>
    @csrf

    <!-- お名前入力 -->
    <div class="contact-form__item contact-form__item--name">
        <label class="contact-form__label contact-form__label--required">お名前</label>
        <div class="name-inputs">
            <div class="input-wrapper">
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="contact-form__input" placeholder="例：山田">
                @error('last_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-wrapper">
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="contact-form__input" placeholder="例：太郎">
                @error('first_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- 性別選択 -->
    <div class="contact-form__item contact-form__item--gender">
        <label class="contact-form__label contact-form__label--required">性別</label>
        <div class="contact-form__input-wrapper">
            <div class="gender-inputs">
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
            @error('gender') <div class="error-message">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- メールアドレス -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">メールアドレス</label>
        <div class="contact-form__input-wrapper">
            <input type="email" name="email" value="{{ old('email') }}" class="contact-form__input" placeholder="例：test@example.com">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- 電話番号入力 -->
    <div class="contact-form__item contact-form__item--tel">
        <label class="contact-form__label contact-form__label--required">電話番号</label>
        <div class="tel-input-wrapper">
            <div class="tel-input-group">
                <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">
                <span class="tel-divider">-</span>
                <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">
                <span class="tel-divider">-</span>
                <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
            </div>
            @if ($errors->has('tel'))
                <div class="error-message">{{ $errors->first('tel') }}</div>
            @endif
        </div>
    </div>

    <!-- 住所入力 -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">住所</label>
        <div class="contact-form__input-wrapper">
            <input type="text" name="address" value="{{ old('address') }}" class="contact-form__input" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
            @error('address') <div class="error-message">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- 建物名入力（任意） -->
    <div class="contact-form__item">
        <label class="contact-form__label">建物名</label>
        <div class="contact-form__input-wrapper">
            <input type="text" name="building" value="{{ old('building') }}" class="contact-form__input" placeholder="例：千駄ヶ谷マンション101">
        </div>
    </div>

    <!-- お問い合わせ種類選択 -->
    <div class="contact-form__item">
        <label class="contact-form__label contact-form__label--required">お問い合わせの種類</label>
        <div class="contact-form__input-wrapper">
            <select name="category_id" class="contact-form__select">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="error-message">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- お問い合わせ内容 -->
    <div class="contact-form__item contact-form__item--textarea">
        <label class="contact-form__label contact-form__label--required">お問い合わせ内容</label>
        <div class="contact-form__input-wrapper">
            <textarea name="detail" rows="5" class="contact-form__textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail') <div class="error-message">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- 確認画面へ送信ボタン -->
    <div class="contact-form__item contact-form__item--button">
        <div class="contact-form__input-wrapper">
            <button type="submit" class="contact-form__button">確認画面</button>
        </div>
    </div>

</form>

@endsection
