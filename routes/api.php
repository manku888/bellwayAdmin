<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CallRequestController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FresherController;
use App\Http\Controllers\Admin\HiringController;
use App\Http\Controllers\Admin\OpenVacancieController;
use Illuminate\Support\Facades\Route;

// Route::prefix('admin')->group(function () {
// });
Route::post('/admin/contact', [ContactController::class, 'store']);


Route::post('/admin/callrequests', [CallRequestController::class, 'store']);


Route::post('/admin/freshers', [FresherController::class, 'store']);

Route::post('admin/experiences', [ExperienceController::class, 'store']);

Route::post('admin/open-vacancies', [OpenVacancieController::class, 'store']);

Route::get('/admin/hirings', [HiringController::class, 'getAll'])->name('api.hirings');
