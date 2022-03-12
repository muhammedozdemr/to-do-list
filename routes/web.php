<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/completed-works', [App\Http\Controllers\HomeController::class, 'completedWorks'])->name('completedWorks');

Route::post('insertData', [App\Http\Controllers\HomeController::class, 'insertData']);
Route::post('editData', [App\Http\Controllers\HomeController::class, 'editData']);
Route::post('/changeStatus', [App\Http\Controllers\HomeController::class, 'changeStatus']);
Route::post('/{id}/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete')->whereNumber('id');
