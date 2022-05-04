<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FavoriController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur toutes les méthodes
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // on récupère le user connecté
        $user = User::find(auth()->user()->id);

        // on charge ses lieux favoris
        $user->load('favoris');

        return response()->json($user->favoris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // on valide l'id du lieu reçu
        $validator = Validator::make($request->all(), [
            'lieu_id' => 'required'  // à transmettre en hidden via le formulaire
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        // on récupère le user connecté
        $user = User::find(auth()->user()->id);

        // on ajoute le lieu sélectionné à ses favoris via la syntaxe favoris()->attach
        // qui cible la table intermédiaire favoris (via relation favoris dans le modèle User)
        $user->favoris()->attach($request->lieu_id);

        // on renvoie la réponse avec un message de confirmation en json
        return response()->json("Lieu ajouté aux favoris");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // // on valide l'id du lieu reçu
        // $validator = Validator::make($request->all(), [
        //     'lieu_id' => 'required'  // à transmettre en hidden via le formulaire
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Error validation', $validator->errors());
        // }
        // on récupère le user connecté
        $user = User::find(auth()->user()->id);

        // on ajoute le lieu sélectionné à ses favoris via la syntaxe favoris()->attach
        // qui cible la table intermédiaire favoris (via relation favoris dans le modèle User)
        $user->favoris()->detach($id);

        // on renvoie la réponse avec un message de confirmation en json
        return response()->json("Lieu retiré des favoris");
    }
}
