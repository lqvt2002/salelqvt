<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin/feedback'], function(){
    Route::get('/index', [App\Http\Controllers\feedback\feedbackcontroller::class, 'index'])->name('feedback_index');
    Route::post('/update', [App\Http\Controllers\feedback\feedbackcontroller::class, 'update'])->name('feedback_update');
    Route::post('/delete', [App\Http\Controllers\feedback\feedbackcontroller::class, 'delete'])->name('feedback_delete');
});