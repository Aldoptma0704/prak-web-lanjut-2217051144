<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/profile', [UserController::class, 'profile']); 
Route::get('/profile/{nama}/{kelas}/{npm}', [ProfileController::class, 'profile']); 

Route::get('/user/create', [UserController::class, 
'create']); 
Route::post('/user/store', [UserController::class, 
'store'])->name('user.store'); 

Route::get('/user', [UserController::class, 
'index'])->name('index'); 

Route::get('/user/list', [UserController::class, 'index'])->name('user.list');
Route::get('/show/{id}', [UserController::class,  'show'])->name('user.show');


Route::get('/user/create', [UserController::class, 'create'])->name('user.create'); //tombol back ke user.creat
Route::get('/user/show{id}', [UserController::class, 'show'])->name('user.show'); //tombol back ke user list

Route::put('/user/{id}/', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');