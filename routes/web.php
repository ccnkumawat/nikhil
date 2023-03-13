<?php

use App\Http\Controllers\NameController;
use App\Http\Controllers\TempleteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[NameController::class,'index']);
Route::get('/names/{name}/edit',[NameController::class,'edit']);
Route::post('/names/store',[NameController::class,'store']);
Route::delete('/names/destroy/{name}',[NameController::class,'destroy']);
Route::get('starter',[TempleteController::class,'starter'])->name('starter');
Route::get('index',[TempleteController::class,'index'])->name('index');
Route::post('create',[TempleteController::class,'store']);
