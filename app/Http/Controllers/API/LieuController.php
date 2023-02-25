<?php

namespace App\Http\Controllers\API;

use App\Models\Lieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LieuController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur store / update / destroy
        $this->middleware('auth:sanctum')->except(['index', 'show', 'getAllPlaces']);
    }


    /**
     * Récupérer les lieux validés uniquement (pour l'affichage utilisateur)
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        $lieux = Lieu::where('statut', 'validé')->get();
        return $this->sendResponse($lieux, 'Lieux validés récupérés avec succès');
    }


    /**
     * Récupérer tous les lieux (pour le back-office admin)
     *
     * @return \Illuminate\Http\Response 
     */
    public function getAllPlaces()
    {
        $lieux = Lieu::all();
        return $this->sendResponse($lieux, 'Lieux récupérés avec succès');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // on précise les critères attendus pour les champs
        // longitude et latitude : intervalles possibles définis avec between
        $validator = Validator::make($request->all(), [
            'nom' => 'required|min:10|max:100',
            'description' => 'required|min:25|max:3000',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'categorie' => 'required|integer',
            'note' => 'required|integer|min:1|max:10',
            'temps' => 'required|integer|min:1|max:24', // temps en heures
            'difficulte' => 'required', // énumération : choix entre "famille", "amateur" et "sportif"
            'kilometres' => 'nullable|integer|min:1|max:100',
            'departement' => 'required',
            'adresse' => 'required|min:5|max:75',
            'code_postal' => 'required|min:5|max:5',
            'ville' => 'required|min:3|max:50',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $message = "";
        // si le user est Admin => on valide directement la création du lieu (valide = true)
        if (User::find($request->user_id)->role->role == "admin") {
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
            // selon le statut de l'utilisateur (admin ou utilisateur standard), on valide ou on met en attente le lieu
            'statut' => User::find($request->user_id)->role->role == "admin" ? "validé" : "en attente",
            'categorie_id' => $request->categorie
        ]);

        // On retourne la réponse JSON (code 201 = ressource créée avec succès)
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
        return $this->sendResponse($lieu, 'Lieu récupéré avec succès');
    }


    // récupérer les lieux postés par l'utilisateur

    public function getPlacesByUser(Request $request)
    {
        $userPlaces = Lieu::where('user_id', intval($request->user_id))->get();
        return $this->sendResponse($userPlaces, 'Nombre de lieux postés récupéré avec succès');
    }


    // récupérer le nombre d'images par lieu

    public function getImagesNumberByPlace(Lieu $lieu)
    {
        $imagesNumber = count($lieu->images);
        return $this->sendResponse($imagesNumber, 'Nombre d\'images pour le lieu récupéré avec succès');
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
            'nom' => 'required|min:10|max:100',
            'description' => 'required|min:25|max:3000',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'categorie_id' => 'required|integer',
            'note' => 'required|min:1|max:10',
            'temps' => 'required|integer|min:1|max:24', // temps en heures
            'difficulte' => 'required', // énumération : choix entre "famille", "amateur" et "sportif"
            'kilometres' => 'nullable|integer|min:1|max:100',
            'departement_id' => 'required|integer',
            'adresse' => 'required|min:5|max:75',
            'code_postal' => 'required|min:5|max:5',
            'ville' => 'required|min:3|max:50',
            'statut' => 'required',
            'commentaire' => 'nullable|min:5|max:1000' // notes de l'admin
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on met à jour le lieu en base de données
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
