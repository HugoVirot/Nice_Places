<?php

namespace App\Http\Controllers\API;

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

    //    /**
    //  * Add a new category to the place.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Lieu  $lieu
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addCategory(Lieu $lieu, Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'categorie_id' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Error validation', $validator->errors());
    //     }

    //     // on ajoute la catégorie à la table intermédiaire avec attach
    //     $lieu->categories()->attach($request['categorie_id']);

    //     return response()->json("Categorie ajoutée au lieu avec succès");
    // }

    // /**
    //  * Add a new category to the place.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Lieu  $lieu
    //  * @return \Illuminate\Http\Response
    //  */

    // public function removeCategory(Lieu $lieu, Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'categorie_id' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Error validation', $validator->errors());
    //     }

    //     // on ajoute la catégorie à la table intermédiaire avec attach
    //     $lieu->categories()->detach($request['categorie_id']);

    //     return response()->json("Categorie retirée du lieu avec succès");
    // }
}
