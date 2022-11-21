<?php

namespace App\Http\Controllers\API;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur store / update / destroy
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return $this->sendResponse($categories, 'Catégories récupérés avec succès');
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
            'nom' => 'required|string|min:5|max:50',
            'icone' => 'required|string|max:50',
            'couleur' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on crée un nouveau lieu
        $categorie = Categorie::create([
            'nom' => $request->nom,
            'icone' => $request->icone,
            'couleur' => $request->couleur
        ]);

        // On retourne les informations en JSON
        $message = "La catégorie a bien été créée";
        return $this->sendResponse($categorie, $message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        $category->load("lieux");
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
            'nom' => 'required|max:50',
            'icone' => 'required|max:50',
            'couleur' => 'required|max:15'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on modifie les infos du lieu
        $category->update($request->except('_token'));

        // On retourne la réponse en JSON
        $message = "La catégorie a bien été modifiée";
        return $this->sendResponse($category, $message, 201);
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
        $message = "Catégorie supprimée avec succès";
        return $this->sendResponse($category, $message);
    }
}
