<?php

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


// *******************Les routes "users.*" de l'API (mode ressource version API, sans create et edit)****************

Route::apiResource("users", App\Http\Controllers\API\UserController::class)->except('store');


// *******************************Les routes "lieux.*" de l'API (même principe)**************************************

Route::apiResource("lieus", App\Http\Controllers\API\LieuController::class);

// récupérer les 3 lieux les mieux notés du département
Route::post('lieus/gettopplacesbydep', [App\Http\Controllers\API\LieuController::class, 'getTopPlacesByDep'])->name('gettopplacesbydep');

// récupérer les 3 derniers lieux postés du département
Route::post('lieus/getlastplacesbydep', [App\Http\Controllers\API\LieuController::class, 'getLastPlacesByDep'])->name('getlastplacesbydep');

// récupérer les lieux postés par l'utilisateur
Route::post('lieus/getplacesbyuser', [App\Http\Controllers\API\LieuController::class, 'getPlacesByUser'])->name('getplacesbyuser');

// récupérer le nombre d'images par lieu
Route::get('lieus/getimagesnumberbyplace/{lieu}', [App\Http\Controllers\API\LieuController::class, 'getImagesNumberByPlace'])->name('getImagesNumberByPlace');


// *****************************Les routes "avis.*" de l'API (même principe)*****************************************

Route::apiResource("avis", App\Http\Controllers\API\AvisController::class);


// ************************Les routes "categories.*" de l'API (même principe)****************************************

Route::apiResource("categories", App\Http\Controllers\API\CategorieController::class);


// ******************************Les routes "favoris.*" de l'API(même principe)**************************************

Route::apiResource("favoris", App\Http\Controllers\API\FavoriController::class)->except('index', 'update', 'show', 'delete');
Route::get('favoris/{user}', [App\Http\Controllers\API\FavoriController::class, 'index'])->name('index');
Route::delete('favoris/{user}/{lieu}', [App\Http\Controllers\API\FavoriController::class, 'destroy'])->name('destroy');

//************************ */ Les routes "favoris.*" de l'API(même principe)*****************************************

Route::apiResource("images", App\Http\Controllers\API\ImageController::class);
