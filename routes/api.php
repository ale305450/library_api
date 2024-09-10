<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Routes for author
    Route::get('/authors', [AuthorController::class, 'index'])->middleware(['permission:view-all-authors']);
    Route::get('/author/show/{author}', [AuthorController::class, 'show']);
    Route::post('/author', [AuthorController::class, 'store'])->middleware(['permission:create-author']);
    Route::post('/author/update/{author}', [AuthorController::class, 'update'])->middleware(['permission:edit-author']);
    Route::delete('/author/delete/{author}', [AuthorController::class, 'destroy'])->middleware(['permission:delete-author']);

    //Route for category
    Route::get('/categories', [CategoryController::class, 'index'])->middleware(['permission:view-all-categories']);
    Route::get('/category/show/{category}', [CategoryController::class, 'show'])->middleware(['permission:view-category']);
    Route::post('/category', [CategoryController::class, 'store'])->middleware(['permission:create-category']);
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->middleware(['permission:edit-category']);
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->middleware(['permission:delete-category']);

    //Routes for book
    Route::get('/books', [BookController::class, 'index'])->middleware(['permission:view-all-books']);
    Route::get('/book/show/{book}', [BookController::class, 'show']);
    Route::post('/book', [BookController::class, 'store'])->middleware(['permission:create-book']);
    Route::put('/book/update/{book}', [BookController::class, 'update'])->middleware(['permission:edit-book']);
    Route::delete('/book/delete/{book}', [BookController::class, 'destroy'])->middleware(['permission:delete-book']);
    Route::post('/book/search', [BookController::class, 'search']);

    //Routes for Reservations
    Route::get('/userReservations', [ReservationController::class, 'userReservations'])->middleware(['permission:view-own-reservations']);
    Route::post('/makeReservations', [ReservationController::class, 'makeReservations'])->middleware(['permission:make-reservations']);
    Route::post('/cancelReservations/{reservation}', [ReservationController::class, 'cancelReservations'])->middleware(['permission:cancel-reservations']);
});
