<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{

    public function livraisonParAgent(){

        $livraisons = Auth::user()->livraisons ;
        return response()->json([
            "livraisons" => $livraisons
        ]) ;
    }

    public function index()
    {
        $livraisons = Livraison::all();
        return response()->json($livraisons);
    }

    public function create(Request $request)
    {
        $request->validate([
            'poids' => 'required|string',
            'category_id' => 'required|integer'
        ]);

        if (Auth::user()->role_id == 3) {

            $livraison = new Livraison();
            $livraison->poids = $request->poids;
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
