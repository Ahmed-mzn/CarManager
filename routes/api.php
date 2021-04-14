<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\ProprietaireController;
use App\Http\Controllers\API\OperationsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'user'=> UserController::class,
    'car'=> CarController::class,
    'proprietaire'=> ProprietaireController::class,
    'operation'=> OperationsController::class,

]);
Route::get('profile',[UserController::class,'profile']);
Route::put('profile', [UserController::class,'UpdateProfile']);
Route::get('findUser', [UserController::class,'search']);
