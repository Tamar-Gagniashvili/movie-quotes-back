<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::post('add/movie', [AdminController::class, 'addMovie']);
Route::post('add/quote', [AdminController::class, 'addQuote']);
Route::delete('/delete/movie/{id}', [AdminController::class, 'deleteMovie']);
Route::delete('/delete/quote/{id}', [AdminController::class, 'deleteQuote']);
Route::get('/edit/movie/{id}', [AdminController::class, 'editMovie']);
Route::patch('/edit/movie/{id}', [AdminController::class, 'updateMovie']);
Route::get('/edit/quote/{id}', [AdminController::class, 'editQuote']);
Route::patch('/edit/quote/{id}', [AdminController::class, 'updateQuote']);

Route::get('quotes', [AdminController::class, 'showQuotes']);
Route::get('movies', [AdminController::class, 'showMovies']);

Route::get('/get-single-quote', [CustomPageController::class, 'getQuote']);
Route::get('/get-quotes/{id}', [CustomPageController::class, 'getQuotes']);
