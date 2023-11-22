<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/order'], function(){
    Route::get('/index', [App\Http\Controllers\order\ordercontroller::class, 'index'])->name('order_index');
    Route::get('/detail', [App\Http\Controllers\order\ordercontroller::class, 'detail'])->name('order_detail');
    Route::post('/update', [App\Http\Controllers\order\ordercontroller::class, 'update'])->name('order_update');
    Route::post('/delete', [App\Http\Controllers\order\ordercontroller::class, 'delete'])->name('order_delete');
});