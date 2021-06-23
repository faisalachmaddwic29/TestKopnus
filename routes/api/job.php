<?php

use App\Http\Controllers\JobVacancy\ApplyJobVacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobVacancy\JobVacanyController;

Route::get('/', [JobVacanyController::class, 'index']);
Route::post('/', [JobVacanyController::class, 'store']);
Route::post('/apply/{id?}', ApplyJobVacancyController::class);
