<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UsersController extends Controller
{

    public function commandesParUtilisateur()
    {
        $commandes = Auth::user()->commandes;
        return response()->json([
            "commandes" => $commandes
        ]);
    }


    public function create()
    {
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->password_confirmation = Hash::make($request->password_confirmation);
        $user->role_id =  4;
        $save = $user->save();
        if ($save) {
            return response()->json([
                "message" => "Vous êtes inscrit avec success"
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
                    "message" => "Vous êtes connecté",
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

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $request->user()->tokens()->where('id', $token->id)->delete();
        return response()->json(["status" => True, "message" => "déconnecté avec succès"]);
    }


    public function pointClient()
    {

        $points = Auth::user()->points;
        return response()->json([
            "points" => $points
        ]);
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
