<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Illuminate\Validation\Rules\Password;

class UserController extends BaseController
{

    public function __construct()
    {
        // middleware sanctum appliqué sur index / update / destroy
        $this->middleware('auth:sanctum')->except(['store']);

        //middleware admin à ajouter pour index (en supplément)
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // On récupère tous les utilisateurs
        $users = User::all();

        // On retourne les informations des utilisateurs en JSON via la fonction sendResponse du BaseController
        // $users = body de la réponse / on peut ajouter un code de statut, faculatif (200 par défaut)
        return $this->sendResponse($users, "Utilisateurs récupérés avec succès");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pseudo' => 'required|max:20|unique:users',
                'email' => 'required|email|max:50|unique:users',
                'password' => [
                    'required', 'confirmed',
                    Password::min(8) // minimum 8 caractères   
                        ->mixedCase() // au moins 1 minuscule et une majuscule
                        ->letters()  // au moins une lettre
                        ->numbers() // au moins un chiffre
                        ->symbols() // au moins un caractère spécial     
                ],
                'departement' => [
                    'nullable'
                ]
            ],
            // message d'erreur pour mdp trop court (n'est pas présent par défaut)
            [
                'password.min' => 'Votre mot de passe doit faire au moins :min caractères.',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'departement_id' => $request->departement
        ]);

        $success['pseudo'] =  $user->pseudo;
        $success["email"] = $user->email;
        $success['id'] = $user->id;

        return $this->sendResponse($success, 'Inscription réussie.', 201);
    }


    /**
     * Return all the user's informations to be displayed on his profile.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        // on retourne uniquement les infos précisées dans la ressource
        //(pseudo et département) => pour le profil public (à venir dans une future version)
        return new UserResource($user);
    }
    

    /**
     * Update the user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'pseudo' => 'required|max:20',
            'email' => 'required|email|max:20',
            'oldPassword' => 'nullable',
            'password' => [
                'nullable', 'confirmed',
                Password::min(8) // minimum 8 caractères   
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()  // au moins une lettre
                    ->numbers() // au moins un chiffre
                    ->symbols() // au moins un caractère spécial     
            ],
            'departement_id' => [
                'nullable'
            ]
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // On modifie les informations de l'utilisateur
        $user->update([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'departement_id' => $request->departement_id
        ]);

        // si nouveau mdp choisi (et qui respecte bien sûr les critères de sécurité du validateur)
        if ($request->password) {

            // si ancien mdp fourni ET valide (vérifié via Hash::check), modification validée 
            if (isset($request->oldPassword) && Hash::check($request->oldPassword, User::find($user->id)->password)) {
                // on sauvegarde le nouveau mot de passe hashé
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                
                // sinon => on renvoie une erreur
            } else {
                return $this->sendError('Error validation', ['mot de passe actuel non renseigné ou incorrect']);
            }
        }

        // on charge le département associé (permet de le mettre à jour en cas de changement)
        $user->load('departement');

        // On retourne la réponse JSON
        return $this->sendResponse($user, 'Modifications validées.', 201);
    }

    /**
     * Remove the user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // On supprime l'utilisateur
        $user->delete();

        // On retourne la réponse JSON
        // return response()->json();
        return $this->sendResponse(null, 'Le compte a bien été supprimé.');
    }
}
