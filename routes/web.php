<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect()->route('login'); });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'config'], function() {
        Route::group(['prefix' => 'school'], function() {
            Route::get('/index',  [App\Http\Controllers\SchoolController::class, 'index'])->name('school.index');
            Route::get('/create',  [App\Http\Controllers\SchoolController::class, 'create'])->name('school.create');
            Route::post('/store',  [App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');
        });
    });
});