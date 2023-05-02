<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->role_id == 1){
            $user = User::findOrFail($id) ;
            $user->role_id = 3 ;
            $user->update() ;

            return response()->json([
                "message" => "Il est nommé agent avec succès"
            ]);
        }else{
            return response()->json([
                "message" => "Vous ne pouvez pas"
            ]) ;
        }
    }

    public function nommerAdmin($id)
    {
        if(Auth::user()->role_id == 1){
            $user = User::findOrFail($id) ;
            $user->role_id = 2 ;
            $user->update() ;

            return response()->json([
                "message" => "Il est nommé admin avec succès"
            ]);
        }else{
            return response()->json([
                "message" => "Vous ne pouvez pas"
            ]) ;
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
