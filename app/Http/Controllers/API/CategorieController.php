<?php

namespace App\Http\Controllers\API;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur toutes les méthodes
        $this->middleware('auth:sanctum');

        //middleware admin à ajouter pour tout (en supplément)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:75',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on crée un nouveau lieu
        $categorie = Categorie::create([
            'nom' => $request->nom
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $category)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:75',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on modifie les infos du lieu
        $category->update($request->except('_token'));

        // On retourne la réponse en JSON
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        $category->delete();

        return response()->json("Catégorie supprimée avec succès");
    }
}
