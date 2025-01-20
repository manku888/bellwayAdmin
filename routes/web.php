<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CallRequestController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FresherController;
use App\Http\Controllers\Admin\HiringController;
use App\Http\Controllers\Admin\OpenVacancieController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('admin/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


    // CRUD Routes for Contact
    Route::prefix('admin')->group(function () {

        // contact
        Route::get('/contacts', [ContactController::class, 'index']);
        // Route::get('/create', [ContactController::class, 'create'])->name('contact.create');
         //Route::post('/stores', [ContactController::class, 'store']);
        // Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
        // Route::put('/update/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/contacts/delete/{id}', [ContactController::class, 'destroy']);


        // call request
        Route::get('/call',[CallRequestController::class,'index']);
        Route::delete('/call/delete/{id}', [CallRequestController::class, 'destroy']);


        // for fresher
        Route::get('/fresher',[FresherController::class,'index']);
        Route::delete('/fresher/delete/{id}', [FresherController::class, 'destroy']);


        Route::get('/experience',[ExperienceController::class,'index']);
        Route::delete('/experience/delete/{id}', [ExperienceController::class, 'destroy']);

        Route::get('/openvacancie',[OpenVacancieController::class,'index']);
        Route::delete('/openvacancie/delete/{id}', [OpenVacancieController::class, 'destroy']);


        // hiring
        Route::get('/hiring',[HiringController::class,'create']);

        Route::get('hiring/index',[HiringController::class,'index']);

        Route::get('/hiring/edit/{id}', [HiringController::class, 'edit']);
        Route::delete('/hiring/delete/{id}', [HiringController::class, 'destroy']);


        Route::post('hiring/store',[HiringController::class,'store']);

        // permissions
        Route::get('/permissions/index', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');



        // Role
        Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');

        Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');



        // users
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');

        // Route::get('/user/create', [RoleController::class, 'create'])->name('role.create');
        // Route::post('/user', [RoleController::class, 'store'])->name('role.store');

        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');





    });






require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
