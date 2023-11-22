<?php

use Illuminate\Support\Facades\Route;

// Route::group(['prefix'=>'/admin/order'], function(){
//     Route::get('/index', [App\Http\Controllers\order\ordercontroller::class, 'index'])->name('order_index');
    
// });
Route::get('/', [App\Http\Controllers\frontend\frontendcontroller::class, 'index'])->name('home_index');

//HIỂN THỊ TRANG SẢN PHẨM
Route::get('/san-pham', [App\Http\Controllers\frontend\frontendcontroller::class, 'showProduct'])->name('frontend_showProduct');

//Liên hệ
Route::get('/lien-he', [App\Http\Controllers\frontend\frontendcontroller::class, 'showContact'])->name('frontend_showContact');
Route::post('/post-lien-he', [App\Http\Controllers\frontend\frontendcontroller::class, 'postContact'])->name('frontend_postContact');

//Giới thiệu
Route::get('/gioi-thieu', [App\Http\Controllers\frontend\frontendcontroller::class, 'showInfor'])->name('frontend_showInfor');

Route::get('/gio-hang', [App\Http\Controllers\frontend\frontendcontroller::class, 'showCart'])->name('frontend_showCart');
Route::post('/post-gio-hang', [App\Http\Controllers\frontend\frontendcontroller::class, 'postCart'])->name('frontend_postCart');

Route::get('/hoan-thanh', [App\Http\Controllers\frontend\frontendcontroller::class, 'showCheckout'])->name('frontend_showCheckout');

Route::get('/not-found', [App\Http\Controllers\frontend\frontendcontroller::class, 'showNotFound'])->name('frontend_showNotFound');

//TRANG CHI TIẾT SẢN PHẨM
Route::get('/{id}-{url}', [App\Http\Controllers\frontend\frontendcontroller::class, 'showDetail'])->name('frontend_showDetail');
