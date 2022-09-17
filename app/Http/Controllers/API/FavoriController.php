<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lieu;

class FavoriController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur toutes les méthodes
        // $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        // on charge les lieux favoris de l'utilisateur
        $user->load('favoris');
        // on les renvoie en format json
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
        // on récupère le user connecté
        $user = User::find($request->user_id);

        // on ajoute le lieu sélectionné à ses favoris via la syntaxe favoris()->attach
        // qui cible la table intermédiaire favoris (via relation favoris dans le modèle User)
        $user->favoris()->attach($request->lieu_id);

        // on renvoie la réponse avec un message de confirmation en json
        $message = "Lieu ajouté aux favoris";
        return $this->sendResponse($request->lieu_id, $message, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Lieu $lieu)
    {
        // on retire le lieu sélectionné à ses favoris via la syntaxe favoris()->detach
        // qui cible la table intermédiaire favoris (via relation favoris dans le modèle User)
        $user->favoris()->detach($lieu->id);

        // on renvoie la réponse avec un message de confirmation en json
        $message = "Lieu retiré des favoris";
        return $this->sendResponse($lieu->id, $message);
    }
}
