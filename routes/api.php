<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/get-single-quote', [CustomPageController::class, 'getQuote']);
Route::get('/get-quotes/{id}', [CustomPageController::class, 'getQuotes']);

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('quotes', [AdminController::class, 'getQuotes']);
    Route::get('movies', [AdminController::class, 'getMovies']);
    Route::get('/quote/{id}', [AdminController::class, 'editQuote']);
    Route::get('/movie/{id}', [AdminController::class, 'editMovie']);

    Route::post('add/movie', [AdminController::class, 'addMovie']);
    Route::post('add/quote', [AdminController::class, 'addQuote']);

    Route::patch('/movie/{id}', [AdminController::class, 'updateMovie']);
    Route::patch('/quote/{id}', [AdminController::class, 'updateQuote']);

    Route::delete('/movie/{id}', [AdminController::class, 'deleteMovie']);
    Route::delete('/quote/{id}', [AdminController::class, 'deleteQuote']);
});
