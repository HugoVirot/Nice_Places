<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LieuController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur store / update / destroy
        // $this->middleware('auth:sanctum')->except(['index', 'show']);

        //middleware admin à ajouter pour destroy (en supplément)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lieux = Lieu::where('valide', true)->get();
        return response()->json($lieux);
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
            'nom' => 'required|max:100|unique:lieus',
            'description' => 'required|max:3000',
            'latitude' => 'required',
            'longitude' => 'required',
            'categorie' => 'required|integer',
            'note' => 'required|integer',
            'temps' => 'required|integer',
            'difficulte' => 'required',
            'adresse' => 'required|max:75',
            'code_postal' => 'required',
            'ville' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $message = "";
        // si le user est Admin => on valide directement la création du lieu (valide = true)
        if ($request->user_id == 1) {
            $message = "Le lieu a bien été créé.";

            // sinon, le lieu est créé mais en attente de validation (valide = false)
            // il n'est donc pas encore affiché sur la carte
        } else {
            $message = "Le lieu a bien été proposé (en attente de validation par l'administrateur).";
        }

        $lieu = Lieu::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'note' => $request->note,
            'temps' => $request->temps,
            'difficulte' => $request->difficulte,
            'adresse' =>  $request->adresse,
            'code_postal' =>  $request->code_postal,
            'ville' =>  $request->ville,
            'user_id' => $request->user_id,
            // selon le statut de l'utilisateur (id 1 = admin), on valide ou non le lieu
            'valide' => $request->user_id == 1 ? true : false
        ]);

        DB::table('categories_lieux')->insert([
            'categorie_id' => $request->categorie,
            'lieu_id' => $lieu->id
        ]);

        // On retourne la réponse JSON
        return $this->sendResponse($lieu, $message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function show(Lieu $lieu)
    {
        return response()->json($lieu);
    }

    // récupérer les trois lieux les mieux notés par département

    public function getTopPlacesByDep(Request $request)
    {
        if ($request->department == "all") {
            $topPlaces = Lieu::orderBy('note', 'desc')
                ->limit(3)
                ->get();
        } else {
            $topPlaces = Lieu::where('code_postal', 'like', "$request->department%")
                ->orderBy('note', 'desc')
                ->limit(3)
                ->get();
        }

        return response()->json($topPlaces);
    }

    // récupérer les trois derniers lieux ajoutés par département

    public function getLastPlacesByDep(Request $request)
    {
        if ($request->department == "all") {
            $lastPlaces = Lieu::latest()
                ->limit(3)
                ->get();
        } else {
            $lastPlaces = Lieu::where('code_postal', 'like', "$request->department%")
                ->latest()
                ->limit(3)
                ->get();
        }

        return response()->json($lastPlaces);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lieu $lieu)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:100',
            'description' => 'required|max:3000',
            'latitude' => 'required',
            'longitude' => 'required',
            'note' => 'required',
            'temps' => 'required',
            'difficulte' => 'required',
            'adresse' => 'required|max:75',
            'code_postal' => 'required',
            'ville' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on modifie les infos du lieu
        $lieu->update($request->except('_token'));

        // On retourne la réponse en JSON
        return response()->json($lieu, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lieu $lieu)
    {
        // on supprime le lieu
        $lieu->delete();

        // on retourne la réponse JSON
        return response()->json("Lieu supprimé avec succès");
    }

    /**
     * Add a new category to the place.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Lieu $lieu, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'categorie_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on ajoute la catégorie à la table intermédiaire avec attach
        $lieu->categories()->attach($request['categorie_id']);

        return response()->json("Categorie ajoutée au lieu avec succès");
    }

    /**
     * Add a new category to the place.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */

    public function removeCategory(Lieu $lieu, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'categorie_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on ajoute la catégorie à la table intermédiaire avec attach
        $lieu->categories()->detach($request['categorie_id']);

        return response()->json("Categorie retirée du lieu avec succès");
    }
}
