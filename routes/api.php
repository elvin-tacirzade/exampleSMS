<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\SmsController\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//auth
Route::post("/register", [RegisterController::class, 'register'])->name('register');
Route::post("/login", [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'api'], function() {
    //logout
    Route::get("/logout", [LoginController::class, 'logout']);
    //messages
    Route::post("/messages/new", [SmsController::class, 'createSMS'])->name('createSMS');
    Route::get("/messages/show", [SmsController::class, 'getSMS'])->name('getSMS');
    Route::get("/messages/show/{id}", [SmsController::class, 'getSMSId'])->name('getSMSId');
});


