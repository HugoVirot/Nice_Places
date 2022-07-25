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
            
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
            'categorie' => 'required|integer',
            'note' => 'required|integer',
            'temps' => 'required|integer',
            'difficulte' => 'required',
            'kilometres' => 'nullable|integer',
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
            'kilometres' => $request->kilometres,
            'adresse' =>  $request->adresse,
            'code_postal' =>  $request->code_postal,
            'ville' =>  $request->ville,
            'user_id' => $request->user_id,
            // selon le statut de l'utilisateur (id 1 = admin), on valide ou non le lieu
            'valide' => $request->user_id == 1 ? true : false,
            'categorie_id' => $request->categorie
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Image::create([
            'nom' => $imageName,
            'user_id' => $request->user_id,
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
        $lieu->load(['avis' => function ($query) {
            $query->latest()->get();
        }]);
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


    // récupérer les lieux postés par l'utilisateur

    public function getPlacesByUser(Request $request)
    {
        $userPlaces = Lieu::where('user_id', intval($request->user_id))->get();

        return response()->json($userPlaces);
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
            'categorie' => 'nullable',
            'difficulte' => 'required',
            'kilometres' => 'nullable|integer',
            'adresse' => 'required|max:75',
            'code_postal' => 'required',
            'ville' => 'required',
            'valide' => 'required'
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
        return $this->sendResponse($lieu, $message, 204);
    }
}
