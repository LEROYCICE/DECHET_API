<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function commandesParUtilisateur()
    {
        $commandes = Auth::user()->commandes ;
        return response()->json([
            "commandes" => $commandes
        ]) ;
    }


    public function create()
    {
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->password_confirmation = Hash::make($request->password_confirmation);
        $user->role_id =  4;
        $save = $user->save();
        if ($save) {
            return response()->json([
                "message" => "Vous etes inscrit avec success"
            ]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('password');

        // Vérifier si le champ "email_or_phone" est un email ou un numéro de téléphone
        $emailOrPhone = $request->input('email_or_phone');
        $field = filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials[$field] = $emailOrPhone;

        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('auth_token')->plainTextToken;
            return response()->json(
                [
                    "message" => "Vous etes conncté",
                    'token' => $token,
                ],
                200
            );
        } else {
            return response()->json([
                'message' => "Information non correcte"
            ]);
        }
    }

    public function profile()
    {
        return response()->json(Auth::user());
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
