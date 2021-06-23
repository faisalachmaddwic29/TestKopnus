<?php

use App\Http\Controllers\Companies\LoginCompanyController;
use App\Http\Controllers\Companies\RegisterCompanyController;
use App\Http\Controllers\Freelances\RegisterFreelanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelances\LoginFreelanceController;

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


Route::post('login', LoginFreelanceController::class);
Route::post('register', RegisterFreelanceController::class);
Route::post('login/company', LoginCompanyController::class);
Route::post('register/company', RegisterCompanyController::class);