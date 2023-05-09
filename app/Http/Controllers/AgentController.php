<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{

    public function livraisonParAgent()
    {

        $livraisons = Auth::user()->livraisons;
        return response()->json([
            "livraisons" => $livraisons
        ]);
    }

    public function index()
    {
        $livraisons = Livraison::join('users', 'livraisons.user_id', 'users.id')
            ->select('livraisons.*', 'users.nom', 'users.phone')
            ->get();
        return response()->json(["livraisons" => $livraisons]);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'poids' => 'required|string',
            'category_id' => 'required|integer'
        ]);

        if (Auth::user()->role_id == 3) {

            $commande = Commande::findOrFail($id);
            $livraison = new Livraison();
            $livraison->poids = $request->poids;
            $livraison->commande_id = $commande->id;
            $livraison->category_id = $request->category_id;
            $livraison->user_id = auth()->id();

            $livraison->save();

            return response()->json([
                "message" => "Enregistrement effectué"
            ]);
        } else {
            return response()->json([
                "message" => "Vous ne pouvez pas enregistrer ces informations"
            ]);
        }
    }


    public function execute($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->is_execute = True;
        $commande->update();
        return response()->json([
            "message" =>  "La commande est exécuté"
        ]);
    }


    public function show($id){
        $livraison = Livraison::findOrFail($id) ;
        return response()->json(["livraison" => $livraison]) ;
    }

    public function edit($id)
    {
        $livraison = Livraison::findOrFail($id) ;
        return response()->json(["livraison" => $livraison]) ;

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'poids' => 'required|string',
            'category_id' => 'required|integer'
        ]);

        $livraison = Livraison::findOrFail($id);
        $livraison->poids = $request->poids;
        $livraison->category_id = $request->category_id;
        $livraison->user_id = auth()->id();
        $livraison->update() ;
        return response()->json(["message" => "livraison bien modifiée"]) ;

    }


    public function destroy($id)
    {
        $livraison = Livraison::findOrFail($id) ;
        $livraison->delete() ;
        return response()->json(["message" => "livraison supprimée"]) ;
    }
}
