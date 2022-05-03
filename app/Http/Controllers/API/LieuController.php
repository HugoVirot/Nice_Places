<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuController extends Controller
{
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
        // on valide les données
        $this->validate($request, [
            'nom' => 'required|max:100',
            'description' => 'required|max:3000',
            'latitude' => 'required',
            'longitude' => 'required',
            'note' => 'required',
            'temps' => 'required',
            'difficulte' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required'
        ]);

        // on crée un nouveau lieu
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
            'ville' =>  $request->ville
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($lieu, 201);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lieu $lieu)
    {
        // on valide les données
        $this->validate($request, [
            'nom' => 'required|max:100',
            'description' => 'required|max:3000',
            'latitude' => 'required',
            'longitude' => 'required',
            'note' => 'required',
            'temps' => 'required',
            'difficulte' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required'
        ]);

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
}
