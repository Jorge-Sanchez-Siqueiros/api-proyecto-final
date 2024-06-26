<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PasoController;
use App\Http\Controllers\RecetaFavController;
use App\Http\Controllers\DashboardController;
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


Route::post("/register",[AuthController::class,'register']);

Route::get("/recetas",[RecipesController::class,'getRecetas']);

Route::get("/recetas/{id}",[RecipesController::class,'getRecetaById']);

Route::get('/favoritas/{id}', [RecetaFavController::class, 'returnFavorites']);

Route::get('/misRecetas/{id}', [RecipesController::class, 'getRecetasByChef']);

Route::get('/dashboard', [DashboardController::class, 'datos']);

Route::post('/recetas', [RecipesController::class, 'create']);
Route::put('/recetas/{id}', [RecipesController::class, 'update']);
Route::delete('/recetas/{id}', [RecipesController::class, 'delete']);

Route::post('/ingredientes', [IngredienteController::class, 'create']);
Route::put('/ingredientes/{id}', [IngredienteController::class, 'update']);
Route::delete('/ingredientes/{id}', [IngredienteController::class, 'delete']);

Route::post('/pasos', [PasoController::class, 'create']);
Route::put('/pasos/{id}', [PasoController::class, 'update']);
Route::delete('/pasos/{id}', [PasoController::class, 'delete']);

Route::post('/receta_fav', [RecetaFavController::class, 'toggleLike']);
Route::get('/recetas/{id}/favorite', [RecetaFavController::class, 'checkFavorite']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
