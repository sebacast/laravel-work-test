<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Models\Favorite;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})
->name('home')
->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::put('favorites/{favorite}/name', [FavoriteController::class, 'updateName'])->name('favorites.update-name')->middleware('auth');
Route::put('favorites/{favorite}/url', [FavoriteController::class, 'updateUrl'])->name('favorites.update-url')->middleware('auth');
Route::resource('favorites', FavoriteController::class)->middleware('auth');

Route::put('users/{user}/name', [UserController::class, 'updateName'])->name('users.update-name')->middleware('auth');
Route::put('users/{user}/birthday', [UserController::class, 'updateBirthday'])->name('users.update-birthday')->middleware('auth');
Route::put('users/{user}/email', [UserController::class, 'updateEmail'])->name('users.update-email')->middleware('auth');
Route::put('users/{user}/password', [UserController::class, 'updatePassword'])->name('users.update-password')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
