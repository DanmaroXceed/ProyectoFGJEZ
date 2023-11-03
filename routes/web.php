<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExtravioController;
use App\Http\Controllers\PersonalController;
use App\Mail\SenderMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {return view('login');})->middleware('guest');

Route::get('/login', function () {return view('login');})->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'signin'])->name('signin');

Route::get('/signup', function () {return view('signup');})->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup-store');

Route::get('home', function () {return view('home');})->name('home')->middleware('auth');

Route::get('/extravio', [ExtravioController::class, 'indexUser'])->name('extravio')->middleware('auth');
Route::post('/extravio', [ExtravioController::class, 'store'])->name('gen-report')->middleware('auth');
Route::delete('/extravio/{id}', [ExtravioController::class,'destroy']) -> name('extravio-destroy')->middleware('auth');
Route::get('/extravio/{id}', [ExtravioController::class,'show']) -> name('extravio-edit')->middleware('auth');
Route::patch('/extravio/{id}', [ExtravioController::class,'update']) -> name('extravio-update')->middleware('auth');

Route::get('/personales', [PersonalController::class, 'indexUser'])->name('personales')->middleware('auth');
Route::get('/personales/{file}', [PersonalController::class, 'down'])->name('down')->middleware('auth');
Route::post('/personales', [PersonalController::class, 'store'])->name('gen-personales')->middleware('auth');
Route::get('/personales/{id}', [PersonalController::class,'show']) -> name('personales-edit')->middleware('auth');
Route::patch('/personales/{id}', [PersonalController::class,'update']) -> name('personales-update')->middleware('auth');

Route::get('/revision', [AdminController::class, 'indexUsers'])->name('revision')->middleware('auth');
Route::patch('/revision/{id}', [AdminController::class,'verifData']) -> name('verificar')->middleware('auth');

Route::get('/view-reports/{id}', [AdminController::class, 'indexreports'])->name('view-reports')->middleware('auth');
Route::patch('/view-reports/verif/{id}', [AdminController::class,'verifreport']) -> name('verif-report')->middleware('auth');

Route::get('prueba-email', function () {
    Mail::to('ejemplo@mail.com')
        ->send(new SenderMailable);
    return 'Enviado con exito';
})->name('prueba-email');