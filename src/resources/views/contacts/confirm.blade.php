@extends('layouts.default')

@section('title', 'お問い合わせ確認')

@section('content')

<h2>Confirm</h2>

<form action="{{ url('/send') }}" method="post" class="contact-form">
    @csrf

    <table class="contact-confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $data['last_name'] }} {{ $data['first_name'] }}
                <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            </td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if($data['gender'] == 1) 男性
                @elseif($data['gender'] == 2) 女性
                @else その他
                @endif
                <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>
                {{ $data['email'] }}
                <input type="hidden" name="email" value="{{ $data['email'] }}">
            </td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>
                {{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}
                <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
                <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
                <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
            </td>
        </tr>
        <tr>
            <th>住所</th>
            <td>
                {{ $data['address'] }}
                <input type="hidden" name="address" value="{{ $data['address'] }}">
            </td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>
                {{ $data['building'] ?? '-' }}
                <input type="hidden" name="building" value="{{ $data['building'] }}">
            </td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>
                {{ $categories->firstWhere('id', $data['category_id'])->content }}
                <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            </td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{!! nl2br(e($data['detail'])) !!}
                <input type="hidden" name="detail" value="{{ $data['detail'] }}">
            </td>
        </tr>
    </table>

    <div class="contact-form__buttons">
        <button type="submit" name="action" value="send" class="contact-form__button">送信</button>
        <button type="submit" name="action" value="back" class="contact-form__button contact-form__button--link">修正</button>
</div>


</form>

@endsection
