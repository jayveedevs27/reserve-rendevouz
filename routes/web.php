<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TableReservationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Table;

Route::get('/', function () {
    return view('welcome');
});

Route::post('api/admin/login', [AuthController::class, 'adminLogin']);

Route::post('/api/register/user', [RegistrationController::class, 'registerUser']);

Route::post('/api/register/delivery-user', [RegistrationController::class, 'registerDeliveryUser']);

//Menu-Item
Route::get('/api/menu-items', [MenuItemController::class, 'index']);
Route::post('/api/menu-item', action: [MenuItemController::class, 'store']);
Route::get('/api/menu-item/{id}', [MenuItemController::class, 'show']);
Route::patch('/api/menu-item/{id}', [MenuItemController::class, 'update']);
Route::delete('/api/menu-item/{id}', [MenuItemController::class, 'destroy']);

//Table
Route::get('/api/tables', [TableController::class, 'index']);
Route::post('/api/table', action: [TableController::class, 'store']);
Route::get('/api/table/{id}', [TableController::class, 'show']);
Route::patch('/api/table/{id}', [TableController::class, 'update']);
Route::delete('/api/table/{id}', [TableController::class, 'destroy']);

//Table Reservation
Route::get('/api/table-Reservations', [TableReservationController::class, 'index']);
Route::post('/api/table-Reservation', [TableReservationController::class, 'store']);
Route::get('/api/table-Reservation/{id}', [TableReservationController::class, 'show']);
Route::patch('/api/table-Reservation/{id}', [TableReservationController::class, 'update']);
Route::delete('/api/table-Reservation/{id}', [TableReservationController::class, 'destroy']);

//Order Item
Route::get('/api/order-Items', [OrderItemController::class, 'index']);
Route::post('/api/order-Item', [OrderItemController::class, 'store']);
Route::get('/api/orderI-tem/{id}', [OrderItemController::class, 'show']);
Route::patch('/api/order-Item/{id}', [OrderItemController::class, 'update']);
Route::delete('/api/order-Item/{id}', [OrderItemController::class, 'destroy']);

//DeliveryDetail
Route::get('/api/delivery-Details', [OrderItemController::class, 'index']);
Route::post('/api/delivery-Detail', [OrderItemController::class, 'store']);
Route::get('/api/delivery-Detail/{id}', [OrderItemController::class, 'show']);
Route::patch('/api/delivery-Detail/{id}', [OrderItemController::class, 'update']);
Route::delete('/api/delivery-Detail/{id}', [OrderItemController::class, 'destroy']);

//Order
Route::get('/api/orders', [OrderController::class, 'index']);
Route::post('/api/order', [OrderController::class, 'store']);
Route::get('/api/order/{id}', [OrderController::class, 'show']);
Route::patch('/api/order/{id}', [OrderController::class, 'update']);
Route::delete('/api/order/{id}', [OrderController::class, 'destroy']);

//User
Route::get('/api/users', [UserController::class, 'index']);
Route::post('/api/user', [UserController::class, 'store']);
Route::get('/api/user/{id}', [UserController::class, 'show']);
Route::patch('/api/user/{id}', [UserController::class, 'update']);
Route::delete('/api/user/{id}', [UserController::class, 'destroy']);







