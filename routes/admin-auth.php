<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\TraineeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Admin\Auth\RegisteredController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredController::class, 'create']) ->name('register');
    Route::post('register', [RegisteredController::class, 'store']);


    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');



//     // CRUD Routes for Contact
// Route::prefix('admin/contact')->group(function () {
//     Route::get('/', [ContactController::class, 'index'])->name('contact.index');
//     Route::get('/create', [ContactController::class, 'create'])->name('contact.create');
//     Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
//     Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
//     Route::put('/update/{id}', [ContactController::class, 'update'])->name('contact.update');
//     Route::delete('/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
// });

    // // CRUD Routes for Trainee
    // Route::resource('trainee', TraineeController::class);

    // // CRUD Routes for Experience
    // Route::resource('experience', ExperienceController::class);


    Route::post('logout', [LoginController::class, 'destroy'])->name('admin/logout');

});
