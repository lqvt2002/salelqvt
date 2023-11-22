<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/category'], function(){
    Route::get('/index', [App\Http\Controllers\category\categorycontroller::class, 'index'])->name('category_index');
    Route::post('/add', [App\Http\Controllers\category\categorycontroller::class, 'add'])->name('category_add');
    Route::post('/delete', [App\Http\Controllers\category\categorycontroller::class, 'delete'])->name('category_delete');
});