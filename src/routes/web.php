<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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


