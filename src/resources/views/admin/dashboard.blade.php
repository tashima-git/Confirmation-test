@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('content')
<h2>Admin</h2>

<!-- 検索フォーム -->
<form method="GET" action="{{ route('admin.dashboard') }}" class="admin-search-form">
    <input type="text" name="name" placeholder="名前やメールアドレス" value="{{ request('name') }}">
    
    <select name="gender">
        <option value="">性別</option>
        <option value="1" {{ request('gender')=='1'?'selected':'' }}>男性</option>
        <option value="2" {{ request('gender')=='2'?'selected':'' }}>女性</option>
        <option value="3" {{ request('gender')=='3'?'selected':'' }}>その他</option>
    </select>

    <select name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id')==$category->id?'selected':'' }}>
                {{ $category->content }}
            </option>
        @endforeach
    </select>

    <input type="date" name="date" value="{{ request('date') }}">

    <button type="submit">検索</button>
    <a href="{{ route('admin.dashboard') }}">リセット</a>
</form>

<!-- エクスポート・ページネーション -->
<div class="admin-actions">
    <button class="export-btn">エクスポート</button>
    {{ $contacts->links() }}
</div>

<!-- お問い合わせ一覧 -->
<table class="admin-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ ['男性','女性','その他'][$contact->gender-1] ?? '' }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>
            <td><button class="detail-btn">詳細</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
