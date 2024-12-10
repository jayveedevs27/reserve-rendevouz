<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('api/admin/login', [AuthController::class, 'adminLogin']);

Route::post('/api/register/user', [RegistrationController::class, 'registerUser']);

Route::post('/api/register/delivery-user', [RegistrationController::class, 'registerDeliveryUser']);

Route::get('/api/menu-items', [MenuItemController::class, 'index']);
Route::post('/api/menu-item', action: [MenuItemController::class, 'store']);
Route::get('/api/menu-item/{id}', [MenuItemController::class, 'show']);
Route::patch('/api/menu-item/{id}', [MenuItemController::class, 'update']);
Route::delete('/api/menu-item/{id}', [MenuItemController::class, 'destroy']);

