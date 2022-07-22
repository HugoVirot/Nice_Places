<?php

namespace App\Http\Controllers\API;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lieu;

class AvisController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur tout sauf show
        // $this->middleware('auth:sanctum')->except(['show']);

        //middleware admin à ajouter pour index (en supplément de sanctum)
    }

    /**
     * Display a listing of the resource for the administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avis = Avis::all();
        return response()->json($avis);
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
            'note' => 'required|max:10',
            'commentaire' => 'nullable|max:2000',
            'lieu_id' => 'required'  // à transmettre en input hidden
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on crée un nouvel avis 
        $avis = Avis::create([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'lieu_id' => $request->lieu_id,
            'user_id' => $request->user_id
        ]);

        // actualiser la note moyenne du lieu en fonction de la note de l'avis

        // 1 ) on récupère le lieu avec son nombre d'avis
        $lieu = Lieu::find($avis->lieu_id);
        $lieu->loadCount('avis');

        // 2) on calcule la nouvelle note moyenne = (note actuelle * nb notes + nouvelle note) / (nb notes + 1)

        $reviewRating = intval($request->note); // intval transforme la note en integer
        $currentAverageRating = $lieu->note;    // note moyenne actuelle de l'article
        $notesNumber = $lieu->avis_count + 1;   // comptage du nombre de notes
        $newAverageRating = ($currentAverageRating * $notesNumber + $reviewRating) / ($notesNumber + 1); // calcul final

        // 3) on la sauvegarde
        $lieu->note = $newAverageRating;
        $lieu->save();

        // On retourne l'avis créé avec un message de confirmation
        $message = "Votre avis a bien été enregistré.";
        return $this->sendResponse($avis, $message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show(Avis $avi)
    {
        return response()->json($avi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avis $avi)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|max:10',
            'commentaire' => 'nullable|max:2000',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $avi->update($request->except('_token'));

        $message = "L'avis a bien été modifié";
        return $this->sendResponse($avi, $message, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avis $avi)
    {
        $avi->delete();
        $message = "Avis supprimé avec succès";
        return $this->sendResponse($avi, $message, 204);
    }
}
