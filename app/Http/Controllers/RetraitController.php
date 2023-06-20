<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Point ;
use App\Models\Retrait;

class RetraitController extends Controller
{
    public function retrait(Request $request)
    {
        $request->validate([
            'montant' => 'integer|min:0',
            'phone' => 'integer'
        ]);

        $user = Auth::user();

        if ($user->points->points < $request->input('montant')) {
            return response()->json(["erreur" => "Votre points est insuffisant"]);
        } else {
            $user->points->points -= $request->input('montant');
            $user->points->save() ;

            $retrait = new Retrait();
            $retrait->user_id = $user->id;
            $retrait->montant = $request->input('montant');
            $retrait->phone = $request->input('phone') ;
            $retrait->status = 'en attente';
            $retrait->save();

            return response()->json(["message" => "Votre demande de retrait est soumise, veuillez patienter pour la confirmation", "statut" => 200]);
        }
    }
}
