<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Models\Commande;
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

Route::get('/roles/index', [RoleController::class, 'index']);

Route::post('/user/register', [UsersController::class, 'register']);

Route::post('/user/login', [UsersController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [UsersController::class, 'profile']);

    //Route pour créer une catégorie par l'admin
    Route::post('/creation-categorie', [CategoryController::class, 'create']);

    // Route pour afficher tout les catégories
    Route::get('/categories/liste', [CategoryController::class, 'index']);

    // Route pour passer une commande par un client
    Route::post('/passer-commande', [CommandeController::class, 'create']);

    // Route pour afficher les clients les agents et les admins
    Route::get('/users/liste', [AdminController::class, 'index']);

    // Route pour afficher tout les commandes
    Route::get('/liste-des-commandes', [CommandeController::class, 'index']);

    // Route pour afficher les produits d'un client
    Route::get('/commandes/client', [UsersController::class, 'commandesParUtilisateur']);

    // Route des commandes par des clients visible à la partie Admin
    Route::get('/commandes/liste/client', [AdminController::class, 'listeDesCommandesDesClients']);

    //Route pour sauvegarder les livraisons par un agent
    Route::post('/commande/confirme/{id}', [AgentController::class, 'create']);

    // Route pour passer la commande en attente à commande exécutée
    Route::put('/commande/{id}/execute', [AgentController::class, 'execute']);

    // Route pour afficher les commandes exécutés
    Route::get('/commandes/execute', [CommandeController::class, 'execute']);

    // Route pour voir les détails d'une commande
    Route::get('/commande/show/{id}' , [CommandeController::class , 'show']) ;

    // Route pour editer une commande
    Route::get('/commande/edit/{id}' , [CommandeController::class , 'edit']) ;

    // Route pour mettre à jour une commande
    Route::put('/commande/update/{id}' , [CommandeController::class , 'update']) ;

    // Route pour supprimer une commande
    Route::delete('/commande/delete/{id}' , [CommandeController::class , 'destroy']) ;


        // Route pour voir les détails d'une livraison
        Route::get('/livraison/show/{id}' , [AgentController::class , 'show']) ;

        // Route pour editer une livraion
        Route::get('/livraison/edit/{id}' , [AgentController::class , 'edit']) ;

        // Route pour mettre à jour une livraison
        Route::put('/livraison/update/{id}' , [AgentController::class , 'update']) ;

        // Route pour supprimer une livraison
        Route::delete('/livraison/delete/{id}' , [AgentController::class , 'destroy']) ;

    //Route pour afficher les livraisons par Agent
    Route::get('/livraisons/agent', [AgentController::class, 'livraisonParAgent']);

    // Route pour afficher tous les livraisons
    Route::get('/livraisons/liste', [AgentController::class, 'index']);

    //Route pour nommer agents
    Route::put('/nommer/agent/{id}', [AdminController::class, 'nommerAgent']);

    // Route pour nommer admin
    Route::put('/nommer/admin/{id}', [AdminController::class, 'nommerAdmin']);

    // Route pour supprimer un utilisateur
    Route::delete('/user/delete/{id}', [AdminController::class, 'destroy']);

    // Route pour afficher chaque utilsateurs avec ses points
    Route::get('/clients/points', [AdminController::class, 'pointsDeChaqueUtilisateur']);

    // Route pour affecter les points à un utilisateur
    Route::put('/client/{id}/points', [AdminController::class, 'affecterPoint']);

    // Route pour afficher à chaque utilisateur ses points
    Route::get('/client/portefeuille', [UsersController::class, 'pointClient']);

    // Route pour la déconnexion
    Route::post('/user/logout', [UsersController::class, 'logout']);
});
