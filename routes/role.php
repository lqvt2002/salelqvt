<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/role'], function(){
    Route::get('/index', [App\Http\Controllers\role\rolecontroller::class, 'index'])->name('role_index');
    Route::post('/add', [App\Http\Controllers\role\rolecontroller::class, 'add'])->name('role_add');
    Route::post('/delete', [App\Http\Controllers\role\rolecontroller::class, 'delete'])->name('role_delete');
});