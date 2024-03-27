<?php

use App\Http\Controllers\mailController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TransactionController::class, 'produits'])->name('home');
Route::get('/paysuccess/{id}', [TransactionController::class, 'success'])->name('pay.success');
Route::get('/othersuccess/{id}', [TransactionController::class, 'othersuccess'])->name('other.success');
Route::post('/save_other_article', [TransactionController::class, 'saveArticle'])->name('store.otherArticle');
Route::post('/pay', [TransactionController::class, 'pay'])->name('pay');
Route::get('/mailContent', [mailController::class, 'content'])->name('emails.content');
Route::get('/mail', [mailController::class, 'index'])->name('emails.index');
Route::get('/getCategories', [TransactionController::class, 'getCategories'])->name('get_categories');
