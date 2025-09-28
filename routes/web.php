<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect()->route('login'); });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'param'], function() {
        Route::group(['prefix' => 'school_year'], function() {
            Route::get('/index', [App\Http\Controllers\SchoolYearController::class, 'index'])->name('year.index');
            Route::post('/store', [App\Http\Controllers\SchoolYearController::class, 'store'])->name('year.store');
            Route::get('/search', [App\Http\Controllers\SchoolYearController::class, 'search'])->name('year.search');
            Route::get('/edit', [App\Http\Controllers\SchoolYearController::class, 'edit'])->name('year.edit');
            Route::post('/edit', [App\Http\Controllers\SchoolYearController::class, 'update'])->name('year.update');
            Route::post('/destroy', [App\Http\Controllers\SchoolYearController::class, 'destroy'])->name('year.destroy');
        });
    });

    Route::group(['prefix' => 'config'], function() {
        Route::group(['prefix' => 'level'], function() {
            Route::get('/index', [App\Http\Controllers\LevelController::class, 'index'])->name('level.index');
        });
        Route::group(['prefix' => 'school'], function() {
            Route::get('/index',  [App\Http\Controllers\SchoolController::class, 'index'])->name('school.index');
            Route::get('/create',  [App\Http\Controllers\SchoolController::class, 'create'])->name('school.create');
            Route::post('/store',  [App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');
            Route::get('/edit',  [App\Http\Controllers\SchoolController::class, 'edit'])->name('school.edit');
            Route::post('/edit',  [App\Http\Controllers\SchoolController::class, 'update'])->name('school.update');
        });
    });
});