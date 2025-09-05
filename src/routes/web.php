<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;


// フォーム入力画面
Route::get('/', [ContactController::class, 'index'])->name('contact.form');

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 送信処理
Route::post('/send', [ContactController::class, 'send'])->name('contact.send');

// サンクスページ
Route::get('/thanks', function () {
    return view('contacts.thanks');
});

// ユーザー登録ページ
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// ログインページ
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.attempt');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// 管理画面
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

});
