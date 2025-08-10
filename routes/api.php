<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CelluleController;
use App\Http\Controllers\EncadreurController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManager;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
Route::middleware('auth:sanctum')->group(function(){
  Route::get('/me',[UserController::class,'me']);
  Route::get('/logout',[UserController::class,'logout']);
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::get('/auth/redirect/google',[SocialiteController::class,'redirectToGoogle']);
Route::get('/auth/google/callback',[SocialiteController::class,'handleGoogleCallback']);

//Encadreurs non fonctionnel
Route::get('/encadreurs',[EncadreurController::class,'index']);
Route::post('/encadreurs/register',[EncadreurController::class,'store']);
Route::put('/encadreurs/{id}',[EncadreurController::class,'update']);
Route::delete('/encadreurs/{id}',[EncadreurController::class,'destroy']);

//Stagiaires non fonctionel
Route::get('/stagiaires', [StagiaireController::class, 'index']);
Route::post('/stagiaires/register', [StagiaireController::class, 'store']);
Route::put('/stagiaires/{id}', [StagiaireController::class, 'update']);
Route::delete('/stagiaires/{id}', [StagiaireController::class, 'destroy']);

//Cellules fonctionnel
Route::get('/cellules',[CelluleController::class, 'index']);
Route::post('/cellules/register',[CelluleController::class,'create']);
Route::put('/cellules/{id}',[CelluleController::class,'update']);
Route::delete('/cellules/{id}',[CelluleController::class,'destroy']);

//utilisateurs
Route::get('/users',[UserManager::class,'index']);


