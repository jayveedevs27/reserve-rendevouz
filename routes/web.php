<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('api/admin/login', [AuthController::class, 'adminLogin']);

Route::post('/api/register/user', [RegistrationController::class, 'registerUser']);

Route::post('/api/register/delivery-user', [RegistrationController::class, 'registerDeliveryUser']);


