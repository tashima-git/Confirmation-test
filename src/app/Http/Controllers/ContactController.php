<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // フォーム表示
    public function index()
    {
        $categories = Category::all();
        return view('contacts.index', compact('categories'));
    }

    // 確認画面
    public function confirm(Request $request)
    {
        // バリデーション設定
        $validator = Validator::make($request->all(), [
            'last_name'   => 'required',
            'first_name'  => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            'address'     => 'required',
            'category_id' => 'required',
            'detail'      => 'required|max:120',
            'tel1'        => 'required',
            'tel2'        => 'required',
            'tel3'        => 'required',
        ], [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
            'tel1.required'        => '電話番号を正しく入力してください',
            'tel2.required'        => '電話番号を正しく入力してください',
            'tel3.required'        => '電話番号を正しく入力してください',
        ]);

        // 電話番号まとめてチェック → tel キーにエラーをまとめる
        $validator->after(function ($validator) use ($request) {
            if (empty($request->tel1) || empty($request->tel2) || empty($request->tel3)) {
                $validator->errors()->add('tel', '電話番号を正しく入力してください');
            }
        });

        // バリデーション失敗時
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 入力値とカテゴリをビューに渡す
        $data = $request->all();
        $categories = Category::all();
        return view('contacts.confirm', compact('data', 'categories'));
    }

    // データ保存＆サンクスページ
    public function send(Request $request)
    {
        if ($request->input('action') === 'back') {
            // 「修正する」が押された場合
            return redirect()
                ->route('contact.form')
                ->withInput();
        }

        // DB保存
        Contact::create([
            'last_name'   => $request->last_name,
            'first_name'  => $request->first_name,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'tel1'        => $request->tel1,
            'tel2'        => $request->tel2,
            'tel3'        => $request->tel3,
            'address'     => $request->address,
            'building'    => $request->building,
            'category_id' => $request->category_id,
            'detail'      => $request->detail,
        ]);

        return redirect('/thanks');
    }
}
