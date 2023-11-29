<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\ApiAuthMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);


Route::middleware(ApiAuthMiddleware::class)->group(function () {

Route::post('/produk/create', [ProdukController::class, 'create']);
Route::get('/produk/list', [ProdukController::class, 'list']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
Route::post('/produk/delete/{id}', [ProdukController::class, 'delete']);

Route::delete('users/logout', [UserController::class, 'logout']);
});