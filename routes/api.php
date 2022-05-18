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

// inscription 
Route::post('register', [App\Http\Controllers\API\UserController::class, 'store'])->name('register');

// connexion utilisateur
Route::post('login', [App\Http\Controllers\API\LoginController::class, 'login'])->name('login');

// Les routes "users.*" de l'API (mode ressource version API, sans create et edit)
Route::apiResource("users", App\Http\Controllers\API\UserController::class)->except('store');

// Les routes "lieux.*" de l'API (même principe)
Route::apiResource("lieus", App\Http\Controllers\API\LieuController::class);

// Les routes "avis.*" de l'API (même principe)
Route::apiResource("avis", App\Http\Controllers\API\AvisController::class);

// Les routes "categories.*" de l'API (même principe)
Route::apiResource("categories", App\Http\Controllers\API\CategorieController::class);

// Les routes "favoris.*" de l'API(même principe)
Route::apiResource("favoris", App\Http\Controllers\API\FavoriController::class)->except('update', 'show');

// Les routes "favoris.*" de l'API(même principe)
Route::apiResource("images", App\Http\Controllers\API\ImageController::class)->except('show');

Route::put('lieus/{lieu}/addcategory', [App\Http\Controllers\API\LieuController::class, 'addCategory'])->name('addcategory');

Route::put('lieus/{lieu}/removecategory', [App\Http\Controllers\API\LieuController::class, 'removeCategory'])->name('removecategory');