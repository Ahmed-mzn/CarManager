<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\ProprietaireController;
use App\Http\Controllers\API\OperationsController;
use App\Http\Controllers\API\ClientController;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Operation;

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
    'client'=> ClientController::class,
]);

Route::get('profile',[UserController::class,'profile']);
Route::put('profile', [UserController::class,'UpdateProfile']);
Route::get('findUser', [UserController::class,'search']);


// Route::get('getCar', [CarController::class,'getCar']);

Route::get('/getCar/{id}', function (Request $request, $id) {
    $car = Car::find($id);
    $op = Operation::where('car_id', $car->id)->get();
    return ['car' => $car, 'operations' => $op];
});