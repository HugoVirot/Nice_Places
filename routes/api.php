<?php

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

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LieuController;
use App\Http\Controllers\API\AuthController;

Route::post('login', [AuthController::class, 'signin']);

// l'inscription fonctionne avec un token créé (mix des 2 tutos)
Route::post('register', [UserController::class, 'store']);

// routes concernées par sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Les routes "users.*" de l'API (mode ressource version API)
    Route::apiResource("users", UserController::class);

    // Les routes "lieux.*" de l'API (mode ressource version API)
    Route::apiResource("lieus", LieuController::class);
});
