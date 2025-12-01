<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect()->route('login'); });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'student'], function() {
        Route::get('/index', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
        Route::get('/data', [App\Http\Controllers\StudentController::class, 'data'])->name('student.data');
        Route::get('/show/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
        Route::get('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
        Route::post('/store', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
        Route::get('/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
        Route::put('/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');

        // Route Ajax End Student
        Route::get('/classe', [App\Http\Controllers\AjaxStudentController::class, 'classe'])->name('ajax.classe');
        Route::get('/serie', [App\Http\Controllers\AjaxStudentController::class, 'serie'])->name('ajax.serie');
        Route::get('/matricule', [App\Http\Controllers\AjaxStudentController::class, 'matricule'])->name('ajax.matricule');
        Route::get('/phon', [App\Http\Controllers\AjaxStudentController::class, 'phon'])->name('ajax.phon');
        Route::get('/natiolity', [App\Http\Controllers\AjaxStudentController::class, 'phnatiolityon'])->name('ajax.natiolity');
    });

    Route::group(['prefix' => 'classe'], function() {
        Route::get('/index', [App\Http\Controllers\ClasseController::class, 'index'])->name('classe.index');
        Route::get('/detail/{id}', [App\Http\Controllers\ClasseController::class, 'show'])->name('classe.show');
        Route::post('/store', [App\Http\Controllers\ClasseController::class, 'store'])->name('classe.store');
        Route::get('/edit', [App\Http\Controllers\ClasseController::class, 'edit'])->name('classe.edit');
        Route::post('/update', [App\Http\Controllers\ClasseController::class, 'update'])->name('classe.update');
        Route::post('/destroy', [App\Http\Controllers\ClasseController::class, 'destroy'])->name('classe.destroy');
    });

    Route::group(['prefix' => 'inscription'], function() {
        Route::get('/index', [App\Http\Controllers\InscriptionController::class, 'index'])->name('inscription.index');
        Route::get('/table', [App\Http\Controllers\InscriptionController::class, 'getData'])->name('inscription.data');
        Route::get('/create', [App\Http\Controllers\InscriptionController::class, 'create'])->name('inscription.create');
        Route::post('/store', [App\Http\Controllers\InscriptionController::class, 'store'])->name('inscription.store');
        Route::get('/show/{id}', [App\Http\Controllers\InscriptionController::class, 'show'])->name('inscription.show');
        Route::get('/edit', [App\Http\Controllers\InscriptionController::class, 'edit'])->name('inscription.edit');
        Route::post('/delete', [App\Http\Controllers\InscriptionController::class, 'destroy'])->name('inscription.delete');
    });

    Route::group(['prefix' => 'evaluated'], function() {
        Route::get('/index', [App\Http\Controllers\EvaluatedController::class, 'index'])->name('evaluated.index');
        Route::get('/data', [App\Http\Controllers\EvaluatedController::class, 'dataTable'])->name('evaluated.data');
        Route::get('/search', [App\Http\Controllers\EvaluatedController::class, 'search'])->name('evaluated.search');
    });

    Route::group(['prefix' => 'param'], function() {
        Route::group(['prefix' => 'cutting'], function() {
            Route::get('/index', [App\Http\Controllers\CuttingController::class, 'index'])->name('cutting.index');
            Route::post('/store', [App\Http\Controllers\CuttingController::class, 'store'])->name('cutting.store');
            Route::get('/edit', [App\Http\Controllers\CuttingController::class, 'edit'])->name('cutting.edit');
            Route::post('/edit', [App\Http\Controllers\CuttingController::class, 'update'])->name('cutting.update');
        });
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
         Route::group(['prefix' => 'slot_time'], function() {
            Route::get('/index',  [App\Http\Controllers\SlotTimeController::class, 'index'])->name('slot.index');
            Route::get('/create',  [App\Http\Controllers\SlotTimeController::class, 'create'])->name('slot.create');
            Route::post('/store',  [App\Http\Controllers\SlotTimeController::class, 'store'])->name('slot.store');
            Route::post('/edit',  [App\Http\Controllers\SlotTimeController::class, 'update'])->name('slot.update');
            Route::get('/search',  [App\Http\Controllers\SlotTimeController::class, 'search'])->name('slot.search');
        });
        Route::group(['prefix' => 'level'], function() {
            Route::get('/index', [App\Http\Controllers\LevelController::class, 'index'])->name('level.index');
            Route::get('/create/{id}', [App\Http\Controllers\LevelController::class, 'create'])->name('level.create');
            Route::get('/show/{id}', [App\Http\Controllers\LevelController::class, 'show'])->name('level.show');
            Route::post('/store', [App\Http\Controllers\LevelController::class, 'store'])->name('level.store');
            Route::get('/edit/{id}', [App\Http\Controllers\LevelController::class, 'edit'])->name('level.edit');
            Route::put('/edit/{id}', [App\Http\Controllers\LevelController::class, 'update'])->name('level.update');
            Route::get('/search', [App\Http\Controllers\LevelController::class, 'search'])->name('level.search');
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