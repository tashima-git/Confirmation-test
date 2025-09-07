@extends('layouts.default')

@section('title', 'お問い合わせ確認')

@section('content')

<h2>Confirm</h2>

<!-- フォーム：送信 or 修正 -->
<form action="{{ url('/send') }}" method="post" class="contact-form">
    @csrf

    <!-- 確認用テーブル -->
    <table class="contact-confirm-table">
        <!-- お名前表示 -->
        <tr>
            <th>お名前</th>
            <td>
                {{ $data['last_name'] }} {{ $data['first_name'] }}
                <!-- 隠しフィールド：送信用 -->
                <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            </td>
        </tr>

        <!-- 性別表示 -->
        <tr>
            <th>性別</th>
            <td>
                @if($data['gender'] == 1) 男性
                @elseif($data['gender'] == 2) 女性
                @else その他
                @endif
                <!-- 隠しフィールド：送信用 -->
                <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            </td>
        </tr>

        <!-- メールアドレス表示 -->
        <tr>
            <th>メールアドレス</th>
            <td>
                {{ $data['email'] }}
                <input type="hidden" name="email" value="{{ $data['email'] }}">
            </td>
        </tr>

        <!-- 電話番号表示 -->
        <tr>
            <th>電話番号</th>
            <td>
                {{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}
                <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
                <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
                <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
            </td>
        </tr>

        <!-- 住所表示 -->
        <tr>
            <th>住所</th>
            <td>
                {{ $data['address'] }}
                <input type="hidden" name="address" value="{{ $data['address'] }}">
            </td>
        </tr>

        <!-- 建物名表示（任意） -->
        <tr>
            <th>建物名</th>
            <td>
                {{ $data['building'] ?? '-' }}
                <input type="hidden" name="building" value="{{ $data['building'] }}">
            </td>
        </tr>

        <!-- お問い合わせ種類表示 -->
        <tr>
            <th>お問い合わせの種類</th>
            <td>
                {{ $categories->firstWhere('id', $data['category_id'])->content }}
                <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            </td>
        </tr>

        <!-- お問い合わせ内容表示 -->
        <tr>
            <th>お問い合わせ内容</th>
            <td>
                {!! nl2br(e($data['detail'])) !!}
                <input type="hidden" name="detail" value="{{ $data['detail'] }}">
            </td>
        </tr>
    </table>

    <!-- 送信・修正ボタン -->
    <div class="contact-form__buttons">
        <!-- 送信 -->
        <button type="submit" name="action" value="send" class="contact-form__button">送信</button>
        <!-- 修正（戻る） -->
        <button type="submit" name="action" value="back" class="contact-form__button contact-form__button--link">修正</button>
    </div>

</form>

@endsection
