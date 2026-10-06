<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'index']);

Route::get('/pasar', function () {
    return view('pasar');
});
Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');