<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function index()
    {
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {

            $clients = User::where('role_id', 4)->get();
            $agents = User::where('role_id', 3)->get();
            $admins = User::where('role_id', 1)->orWhere('role_id', 2)->get();
            return response()->json([
                "clients" => $clients,
                "agents" => $agents,
                "admins" => $admins
            ]);
        } else {
            return response()->json([
                "message" => "Vous n'avez pas droit à ces ressources"
            ]);
        }
    }

    public function nommerAgent($id)
    {
        if (Auth::user()->role_id == 1) {
            $user = User::findOrFail($id);
            $user->role_id = 3;
            $user->update();

            return response()->json([
                "message" => "Il est nommé agent avec succès"
            ]);
        } else {
            return response()->json([
                "message" => "Vous ne pouvez pas effectuer cet action"
            ]);
        }
    }

    public function nommerAdmin($id)
    {
        if (Auth::user()->role_id == 1) {
            $user = User::findOrFail($id);
            $user->role_id = 2;
            $user->update();

            return response()->json([
                "message" => "Il est nommé admin avec succès"
            ]);
        } else {
            return response()->json([
                "message" => "Vous ne pouvez pas effectuer cet action"
            ]);
        }
    }

    public function listeDesCommandesDesClients()
    {
        $commandes = Commande::join('users', 'commandes.user_id', '=', 'users.id')
            ->select('commandes.*', 'users.nom', 'users.phone', 'commandes.id')
            ->get();

        return response()->json($commandes);
    }

    public function affecterPoint(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:0'
        ]);
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {

            $user = User::findOrFail($id);
            $points = new Point;
            $points->user_id = $user->id;
            $points->admin_id = auth()->id() ;
            $points->points += $request->points;
            $points->update();

            return response()->json([
                "message" => "Les points de l\'utilisateur ont été mis à jour avec succès."
            ]);
        }
    }

    public function pointsDeChaqueUtilisateur()
    {
        $users = User::leftJoin('points', 'users.id', '=', 'points.user_id')
            ->select('users.nom', 'users.phone', 'points.points')
            ->get();

        return response()->json($users) ;
    }

    public function destroy($id)
    {
        if (Auth::user()->role_id == 1) {

            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                "message" => "L'utilisateur supprimé avec succès"
            ]);
        }
    }

}
