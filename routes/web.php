<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
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

Route::get('/', [AlbumController::class, 'firstPage'])->name('index');

Route::get('/albums/{page}', [AlbumController::class, 'viewPage']);

Route::get('/add', function () {
   return view('add');
})->name('add');

Route::get('/edit/{id}', [AlbumController::class, 'editAlbum'])->middleware('auth')->name('editAlbum');

Route::post('/api/album/add', [AlbumController::class, 'add'])->name('album-add');
Route::post('/api/album/edit', [AlbumController::class, 'edit'])->name('album-edit');

Route::get('/auth', function () {
    return view('auth');
})->name('auth');

Route::post('/api/auth', [AuthController::class, 'auth'])->name('api-auth');
Route::get('/api/logout', [AuthController::class, 'logout'])->name('api-logout');

Route::get('/logs', [LogController::class, 'logs'])->middleware('auth')->name('logs');
