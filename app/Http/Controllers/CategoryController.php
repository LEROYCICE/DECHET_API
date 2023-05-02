<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $request->validate([
            'nom' => 'required|string'
        ]);

        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {

            $category = new Category();
            $category->nom = $request->nom;
            $category->save();
            return response()->json([
                'message' => 'Catgérorie créée avec succès'
            ]);
        } else {
            return response()->json([
                'message' => 'Vous ne pouvez pas créer une nouvelle catégorie'
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
