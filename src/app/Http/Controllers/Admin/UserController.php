<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* =============================
       ユーザー登録フォーム表示
    ============================= */
    public function create()
    {
        return view('admin.register'); // ユーザー登録画面
    }

    /* =============================
       ユーザー登録処理
    ============================= */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.unique' => 'このメールアドレスはすでに使われています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ]);

        // ユーザー作成（パスワードはハッシュ化）
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録完了メッセージ付きでダッシュボードへ
        return redirect()->route('admin.dashboard')->with('success', 'ユーザー登録が完了しました');
    }

    /* =============================
       ログインフォーム表示
    ============================= */
    public function loginForm()
    {
        return view('admin.login'); // ログイン画面
    }

    /* =============================
       ログイン処理
    ============================= */
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ]);

        // 認証
        if (auth()->attempt($request->only('email','password'))) {
            return redirect()->route('admin.dashboard'); // 認証成功
        }

        // 認証失敗
        return back()->withErrors(['email'=>'メールアドレスまたはパスワードが間違っています']);
    }

    /* =============================
       ログアウト処理
    ============================= */
    public function logout()
    {
        auth()->logout(); // セッション破棄
        return redirect()->route('login'); // ログイン画面へ
    }
}
