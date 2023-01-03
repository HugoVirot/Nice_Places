<?php

namespace App\Http\Controllers\API;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lieu;
use App\Models\User;

class AvisController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur tout sauf show
        $this->middleware('auth:sanctum')->except(['show']);

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
        return $this->sendResponse($avis, 'Avis récupérés avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lieu  $lieu
     * @return \Illuminate\Http\Response
     */
    public function show(Avis $avi)
    {
        return $this->sendResponse($avi, 'Avis récupéré avec succès');
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
            'note' => 'required|integer|min:1|max:10',
            'commentaire' => 'nullable|min:5|max:2000',
            'lieu_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // on crée un nouvel avis 
        $avis = Avis::create([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'lieu_id' => $request->lieu_id,
            'user_id' => $request->user_id,
            // selon le statut de l'utilisateur (admin ou utilisateur standard), on valide ou on met en attente l'avis
            'statut' => User::find($request->user_id)->role->role == "admin" ? "validé" : "en attente",
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avis $avi)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|integer|min:1|max:10',
            'commentaire' => 'nullable|min:5|max:2000',
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
        return $this->sendResponse($avi, $message);
    }
}
