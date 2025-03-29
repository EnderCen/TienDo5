<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('home');
});

Route::post('/face_swap', [AIController::class, 'faceSwap']);
Route::post('/text_to_speech', [AIController::class, 'textToSpeech']);
Route::post('/animate_image', [AIController::class, 'animateImage']);
Route::get('/', function () {
    return view('home');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login.process');