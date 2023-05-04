<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
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

    // Route pour passer une commande
    Route::post('/passer-commande' , [CommandeController::class , 'create']) ;

    // Route pour afficher les clients les agents et les admins
    Route::get('/clients-agents-admins' , [AdminController::class , 'index']) ;

    // Route pour afficher tout les commandes
    Route::get('/liste-des-commandes' , [CommandeController::class , 'index']) ;

    // Route pour afficher les produits d'un client
    Route::get('/commandes-par-client' , [UsersController::class , 'commandesParUtilisateur']) ;

    //Route pour sauvegarder les livraisons par un agent
    Route::post('/agent-confirme-commande' , [AgentController::class , 'create']) ;

    //Route pour afficher les livraisons par Agent
    Route::get('/livraisons-par-agent' , [AgentController::class , 'livraisonParAgent']) ;

    //Route pour nommer agents
    Route::put('/nommer-agent/{id}' , [AdminController::class , 'nommerAgent']) ;

    // Route pour nommer admin
    Route::put('/nommer-admin/{id}' , [AdminController::class , 'nommerAdmin']) ;

    // Route pour supprimer un utilisateur
    Route::delete('/supprrimer-utilisateur' , [AdminController::class , 'destroy']) ;

    // Route des commandes par des clients visible à la partie Admin
    Route::get('/listes-des-commandes-des-clients' , [AdminController::class , 'listeDesCommandesDesClients']) ;

    // Route pour afficher chaque utilsateurs avec ses points
    Route::get('/liste-des-clients-avec-points' , [AdminController::class , 'pointsDeChaqueUtilisateur']) ;

    // Route pour affecter les points à un utilisateur
    Route::post('/client/{id}/points' , [AdminController::class , 'affecterPoint']) ;

    // Route pour afficher à chaque utilisateur ses points
    Route::get('/client-points' , [UsersController::class ,'pointClient']) ;

    // Route pour la déconnexion
    Route::get('/deconnexion' , [UsersController::class , 'logout']) ;
});
