<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /* =============================
       お問い合わせ一覧表示
       - ページネーション付きで一覧表示
    ============================= */
    public function index()
    {
        $contacts = Contact::paginate(10); // 1ページあたり10件
        return view('admin.contacts.index', compact('contacts'));
    }

    /* =============================
       お問い合わせ詳細表示
       - ID指定で1件の詳細を表示
    ============================= */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /* =============================
       お問い合わせ削除
       - 指定IDのデータを削除
       - 削除後、ダッシュボードにリダイレクト
    ============================= */
    public function destroy($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'お問い合わせを削除しました。');
    }
}
