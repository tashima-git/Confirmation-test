<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // 一覧表示
    public function index()
    {
        $contacts = Contact::paginate(10); // ページネーション
        return view('admin.contacts.index', compact('contacts'));
    }

    // 詳細表示
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    // 削除処理
    public function destroy($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'お問い合わせを削除しました。');
    }


}
