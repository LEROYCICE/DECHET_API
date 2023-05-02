<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register' , [UsersController::class , 'register']) ;

Route::post('/login' , [UsersController::class ,'login']) ;

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('/profile' , [UsersController::class , 'profile']) ;

    //Route pour créer une catégorie par l'admin
    Route::post('/creation-categorie' , [CategoryController::class , 'create']) ;
});
