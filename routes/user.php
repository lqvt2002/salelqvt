<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/user'], function(){
    Route::get('/index', [App\Http\Controllers\user\usercontroller::class, 'index'])->name('user_index');
    Route::get('/viewAdd', [App\Http\Controllers\user\usercontroller::class, 'viewAdd'])->name('user_viewAdd');
    Route::post('/add', [App\Http\Controllers\user\usercontroller::class, 'add'])->name('user_add');
    Route::post('/delete', [App\Http\Controllers\user\usercontroller::class, 'delete'])->name('user_delete');
});