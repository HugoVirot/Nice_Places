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
        $this->middleware('auth:sanctum')->except(['store', 'show']);

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

        // On retourne les informations des utilisateurs en JSON
        // $users = body de la réponse / on peut ajouter un code de statut, faculatif (200 par défaut)
        return response()->json($users);
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
                'departement' => 'nullable|max:3'
            ],
            // messages d'erreur personnalisés
            [
                'password.min' => 'Votre mot de passe doit faire au moins :min caractères.',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors(), 400);
        }

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'departement' => $request->departement
        ]);

        // création d'un token pour le user
        $success['token'] =  $user->createToken('RegistrationUser' . $user->id)->plainTextToken;
        $success['pseudo'] =  $user->pseudo;
        $success["email"] = $user->email;

        return $this->sendResponse($success, 'Inscription réussie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // 2) on retourne uniquement les infos précisées dans la ressource
        //(pseudo et département) => pour le profil public
        return new UserResource($user);
    }

    /**
     * Return all the user's informations to be displayed on his profile.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        // 1) On retourne toutes les informations de l'utilisateur en JSON
        return response()->json($user);
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
            'pseudo' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'departement' => 'required|max:3'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        // On modifie les informations de l'utilisateur
        $user->update([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'departement' => $request->departement
        ]);

        // On retourne la réponse JSON
        return response()->json($user, 200);
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
        return response()->json();
    }
}
