<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\CvController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');
Route::get('/question/store', [QuestionController::class, 'response'])->name('question.response');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pelanggan', PelangganController::class);

Route::get('/', function () {
    return redirect()->route('cv.index');
});

Route::get('/cv', [CvController::class, 'index'])->name('cv.index');
Route::post('/cv', [CvController::class, 'store'])->name('cv.store');
Route::put('/cv/profile/{id}', [CvController::class, 'updateProfile'])->name('cv.updateProfile');
Route::put('/cv/{id}', [CvController::class, 'update'])->name('cv.update');
Route::delete('/cv/{id}', [CvController::class, 'destroy'])->name('cv.destroy');
Route::get('/cv/show/{id}', [CvController::class, 'show'])->name('cv.show');