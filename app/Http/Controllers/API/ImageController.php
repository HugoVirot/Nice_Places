<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImageController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur index / store / update / destroy
        // $this->middleware('auth:sanctum');

        //middleware admin à ajouter pour index (en supplément)
    }


    /**
     * Display a listing of all the images for the administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
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
            'nom' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profil' => 'required|boolean',
            'lieu_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $imageName = time() . '.' . $request->nom->extension();

        $request->nom->move(public_path('images'), $imageName);

        // on crée un nouveau lieu
        $image = Image::create([
            'nom' => $imageName,
            'profil' => $request->profil,
            'lieu_id' => $request->lieu_id,
            'user_id' => Auth::user()->id
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($image, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return response()->json($image);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        // ici, l'update ne concerne que "profil" => l'utilisateur la choisit en tant qu'image
        // de profil ou la déselectionne
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'mise_en_avant' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $image->update($request->except('_token'));

        // si l'image est mise en avant, on désactive la mise en avant sur l'autre image mise en avant pour le lieu en question
        if ($request->mise_en_avant) {
            $samePlaceCoverImage = Image::where(['lieu_id' => $image->lieu_id, 'mise_en_avant' => true])->get();
            $samePlaceCoverImage = $samePlaceCoverImage[0];
            $samePlaceCoverImage->mise_en_avant = false;
            $samePlaceCoverImage->save();
        }

        // On retourne la réponse en JSON
        $message = "L'image a bien été modifiée";
        return $this->sendResponse($image, $message, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        // on supprime l'image du dossier public/images
        File::delete(public_path("images/" . $image->nom));

        // on la supprime de la table images
        $image->delete();

        // on retourne la réponse en json
        return response()->json("Image supprimée avec succès");
    }
}
