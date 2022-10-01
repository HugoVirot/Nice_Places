<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // ********************************** sauvegarde de l'image *************************************

        // on récupère le nombre d'images pour ce lieu
        $imagesTotalForPlace = Image::where('lieu_id', $request->lieu_id)->count();

        // on accède à l'image transmise via le formulaire
        $image = $request->file('image');

        //nom de l'image = nom du lieu (espaces changés en underscores) + _image_ + le N° de l'image pour ce lieu + l'extension
        $imageName = str_replace(' ', '_', substr($request->nom_lieu, 0, 20)) . "_image_" . $imagesTotalForPlace + 1  . '.' . $image->extension();

        // on récupère les dimensions de l'image
        $imageInfos = getimagesize($image);

        // on récupère le poids en kb de l'image
        $fileSize = round(filesize($image) / 1000);

        // on déplace l'image de son emplacement temporaire vers le dossier public/images
        $image->move(public_path('images'), $imageName);

        // on sauvegarde l'image en bdd
        Image::create([
            'nom' => $imageName,
            'user_id' => $request->user_id,
            'lieu_id' => $request->lieu_id,
            'longueur' => $imageInfos[0],
            'largeur' => $imageInfos[1],
            'taille' => $fileSize,
            'mise_en_avant' => $imagesTotalForPlace == 0 ? true : false, // on la met en avant si c'est la première postée pour ce lieu
            'statut' => $request->user_id == 1 ? "validée" : "en attente"
        ]);

        // on retourne un message de succès et les noms des images uploadées
        $message = "Image envoyée avec succès !";

        if ($request->user_id !== 1) {
            $message .= " En attente de validation par l'administrateur.";
        }

        return $this->sendResponse($image, $message);
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
        $validator = Validator::make($request->all(), [
            'mise_en_avant' => 'required|boolean',
            'statut' => 'required'
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

        // on supprime l'image si son statut est "refusée" (on vérifie par précaution que le fichier existe)
        if ($image->statut == "refusée" && File::exists(public_path('images/' . $image->nom))) {
            File::delete(public_path('images/' . $image->nom));
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
        $message = "L'image a bien été supprimée";
        return $this->sendResponse($image, $message);
    }
}
