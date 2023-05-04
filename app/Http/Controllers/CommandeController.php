<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{

    public function index()
    {
        $commandes = Commande::all();
        return response()->json($commandes);
    }


    public function create(Request $request)
    {
        $request->validate([
            'poids' => 'required|string',
            'adresse' => 'required|string',
            'category_id' => 'required|integer'
        ]);

        $commande = new Commande();
        $commande->poids = $request->poids;
        $commande->adresse = $request->adresse;
        $commande->user_id = auth()->id();
        $commande->category_id = $request->category_id;

        $save = $commande->save();
        if ($save) {
            return response()->json([
                "message" => "Commande passée avec succès"
            ]);
        }
        return response()->json([
            "message" => "Veuillez remplir tous les champs"
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
