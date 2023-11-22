<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/product'], function(){
    Route::get('/index', [App\Http\Controllers\product\productcontroller::class, 'index'])->name('product_index');
    Route::get('/viewAdd', [App\Http\Controllers\product\productcontroller::class, 'viewAdd'])->name('product_viewAdd');
    Route::post('/add', [App\Http\Controllers\product\productcontroller::class, 'add'])->name('product_add');
    Route::post('/delete', [App\Http\Controllers\product\productcontroller::class, 'delete'])->name('product_delete');
});