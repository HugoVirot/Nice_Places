<?php

namespace App\Http\Controllers\API;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'lieu_id' => 'required'  // à transmettre en input hidden
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $avi->update($request->except('_token'));

        return response()->json($avi, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avis $avis)
    {
        $avis->delete();
        return response()->json("Avis supprimé avec succès");
    }
}
