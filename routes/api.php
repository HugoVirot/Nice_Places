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

// ****************** Inscription et connexion ****************

// inscription 
Route::post('register', [App\Http\Controllers\API\UserController::class, 'store'])->name('register');

// connexion 
Route::post('login', [App\Http\Controllers\API\LoginController::class, 'login'])->name('login');


// ****************** Pour toutes les routes : apiResource = mode ressource version API, sans create et edit ****************

// **************************************** routes USERS ***************************************************

Route::apiResource("users", App\Http\Controllers\API\UserController::class)->except('store');


// **************************************** routes LIEUX ***************************************************

Route::apiResource("lieus", App\Http\Controllers\API\LieuController::class);

// récupérer les lieux postés par l'utilisateur
Route::post('lieus/getplacesbyuser', [App\Http\Controllers\API\LieuController::class, 'getPlacesByUser'])->name('getplacesbyuser');

// récupérer le nombre d'images par lieu
Route::get('lieus/getimagesnumberbyplace/{lieu}', [App\Http\Controllers\API\LieuController::class, 'getImagesNumberByPlace'])->name('getImagesNumberByPlace');


// ******************************************* routes AVIS *********************************************

Route::apiResource("avis", App\Http\Controllers\API\AvisController::class);


// ************************************** routes CATEGORIES *************************************************

Route::apiResource("categories", App\Http\Controllers\API\CategorieController::class);


// **************************************** routes FAVORIS ********************************************

Route::apiResource("favoris", App\Http\Controllers\API\FavoriController::class)->except('index', 'update', 'show', 'delete');
Route::get('favoris/{user}', [App\Http\Controllers\API\FavoriController::class, 'index'])->name('index');
Route::delete('favoris/{user}/{lieu}', [App\Http\Controllers\API\FavoriController::class, 'destroy'])->name('destroy');


//**************************************** routes IMAGES ***********************************************

Route::apiResource("images", App\Http\Controllers\API\ImageController::class);


//************************************** routes NOTIFICATIONS *************************************************

Route::apiResource("notifications", App\Http\Controllers\API\NotificationController::class)->except('index');
Route::get('getnotificationsbyuser/{user}', [App\Http\Controllers\API\NotificationController::class, 'getNotificationsByUser'])->name('getNotificationsByUser');


//************************************** route DEPARTEMENTS *************************************************

route::get("/departements", App\Http\Controllers\API\DepartementController::class)->name("getDepartements");


//************************************** route REGIONS *************************************************

route::get("/regions", App\Http\Controllers\API\RegionController::class)->name("getRegions");
