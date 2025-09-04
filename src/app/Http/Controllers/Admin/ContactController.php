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

    // 編集フォーム
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'detail' => 'required|max:120',
        ]);

        $contact->update($request->all());

        return redirect()->route('admin.contacts.index')->with('success', 'お問い合わせを更新しました');
    }

    // 削除処理
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'お問い合わせを削除しました');
    }
}
