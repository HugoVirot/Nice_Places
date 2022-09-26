<?php

namespace App\Http\Controllers\API;

use App\Models\Lieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;

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
        $lieux = Lieu::all();
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
            'nom' => 'required|max:100',
            'description' => 'required|max:3000',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'categorie' => 'required|integer',
            'note' => 'required|integer|max:10',
            'temps' => 'required|integer',
            'difficulte' => 'required',
            'kilometres' => 'nullable|integer|max:100',
            'departement' => 'required',
            'adresse' => 'required|max:75',
            'code_postal' => 'required|max:5',
            'ville' => 'required|max:50'
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

        // ************************************ sauvegarde du lieu *************************************

        $lieu = Lieu::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'note' => $request->note,
            'temps' => $request->temps,
            'difficulte' => $request->difficulte,
            'kilometres' => $request->kilometres,
            'departement_id' => $request->departement,
            'adresse' =>  $request->adresse,
            'code_postal' =>  $request->code_postal,
            'ville' =>  $request->ville,
            'user_id' => $request->user_id,
            // selon le statut de l'utilisateur (id 1 = admin), 
            // on valide ou on met en attente le lieu
            'statut' => $request->user_id == 1 ? "validé" : "en attente",
            'categorie_id' => $request->categorie
        ]);

        // on stocke l'id du lieu créé en session (pour l'upload d'image juste après)
        // session()->put('lieu_id', $lieu->id);

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
        $lieu->load(['avis' => function ($query) {
            $query->latest()->get();
        }]);
        $lieu->load('images');
        return response()->json($lieu);
    }


    // récupérer les lieux postés par l'utilisateur

    public function getPlacesByUser(Request $request)
    {
        $userPlaces = Lieu::where('user_id', intval($request->user_id))->get();
        return response()->json($userPlaces);
    }


    // récupérer le nombre d'images par lieu

    public function getImagesNumberByPlace(Lieu $lieu)
    {
        $imagesNumber = count($lieu->images);
        return response()->json($imagesNumber);
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
            'categorie_id' => 'required',
            'difficulte' => 'required',
            'kilometres' => 'nullable|integer',
            'adresse' => 'required|max:75',
            'code_postal' => 'required',
            'ville' => 'required',
            'statut' => 'required',
            'commentaire' => 'nullable|max:1000'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on modifie les infos du lieu
        $lieu->update($request->except('_token'));

        // On retourne la réponse en JSON
        $message = "Lieu modifié avec succès";
        return $this->sendResponse($lieu, $message);
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
        $message = "Lieu supprimé avec succès";
        return $this->sendResponse($lieu, $message);
    }
}
