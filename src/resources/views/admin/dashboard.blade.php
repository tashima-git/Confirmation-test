@extends('layouts.default')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-dashboard">
    <h2>Admin</h2>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="admin-search-form">

        <!-- 名前／メールアドレス  -->
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

        <!-- 性別 -->
        <select name="gender">
            <option value="">性別</option>
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender')=='1'?'selected':'' }}>男性</option>
            <option value="2" {{ request('gender')=='2'?'selected':'' }}>女性</option>
            <option value="3" {{ request('gender')=='3'?'selected':'' }}>その他</option>
        </select>

        <!-- お問い合わせ種類 -->
        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id')==$category->id?'selected':'' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <!-- 日付 -->
        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit">検索</button>
        <a href="{{ route('admin.dashboard') }}">リセット</a>
    </form>

    <!-- エクスポート -->
    <div class="admin-actions">
        <form method="GET" action="{{ route('admin.export') }}">
            @csrf
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">

            <button type="submit" class="export-btn">エクスポート</button>
        </form>

        <!-- ページネーション -->
        <ul class="pagination">
            <!-- 前のページ -->
            @if ($contacts->onFirstPage())
                <span class="prev">&lt;</span>
            @else
                <a href="{{ $contacts->previousPageUrl() }}" class="prev">&lt;</a>
            @endif

            <!-- ページ番号 -->
            @php
                $start = max(1, $contacts->currentPage() - 2);
                $end = min($contacts->lastPage(), $contacts->currentPage() + 2);
                if ($contacts->currentPage() <= 2) {
                    $end = min(5, $contacts->lastPage());
                }
                if ($contacts->currentPage() >= $contacts->lastPage() - 1) {
                    $start = max(1, $contacts->lastPage() - 4);
                }
            @endphp

            @foreach ($contacts->getUrlRange($start, $end) as $page => $url)
                @if ($page == $contacts->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            <!-- 次のページ -->
            @if ($contacts->hasMorePages())
                <a href="{{ $contacts->nextPageUrl() }}" class="next">&gt;</a>
            @else
                <span class="next">&gt;</span>
            @endif
        </ul>
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
                <td>
                    <a href="#modal-{{ $contact->id }}" class="detail-btn">詳細</a>
                </td>
            </tr>

            <div id="modal-{{ $contact->id }}" class="admin-modal">
                <div class="admin-modal-content">
                    <a href="#!" class="admin-modal-close">&times;</a>

                    <div class="modal-row">
                        <span class="label">お名前</span>
                        <span class="value">{{ $contact->last_name }} {{ $contact->first_name }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">性別</span>
                        <span class="value">{{ ['男性','女性','その他'][$contact->gender-1] ?? '' }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">メールアドレス</span>
                        <span class="value">{{ $contact->email }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">電話番号</span>
                        <span class="value">{{ $contact->tel1 }}-{{ $contact->tel2 }}-{{ $contact->tel3 }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">住所</span>
                        <span class="value">{{ $contact->address }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">建物名</span>
                        <span class="value">{{ $contact->building }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">お問い合わせ種類</span>
                        <span class="value">{{ $contact->category->content ?? '' }}</span>
                    </div>

                    <div class="modal-row">
                        <span class="label">お問い合わせ内容</span>
                        <span class="value">{{ $contact->detail }}</span>
                    </div>

                    <!-- 削除ボタン -->
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">削除</button>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
