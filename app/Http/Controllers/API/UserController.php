<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
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
        // $users = body de la réponse / on peut ajouter un code de statut, faculatif
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
        // ************** tuto akilischool ************

        // // La validation de données
        // $this->validate($request, [
        //     'pseudo' => 'required|max:100',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8',
        //     'departement' => 'required|max:3'
        // ]);

        // // On crée un nouvel utilisateur
        // $user = User::create([
        //     'pseudo' => $request->pseudo,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'departement' => $request->departement
        // ]);

        // // On retourne les informations du nouvel utilisateur en JSON
        // return response()->json($user, 201);

        // ************** tuto tutswinds (mixé avec akilischool) *********
        $validator = Validator::make($request->all(), [
            'pseudo' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'departement' => 'required|max:3'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'departement' => $request->departement
        ]);

        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['pseudo'] =  $user->pseudo;
   
        return $this->sendResponse($success, 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // 1) On retourne les informations de l'utilisateur en JSON
        //return response()->json($user);
        
        // 2) on retourne uniquement les infos précisées dans la ressource
        //(pseudo et département) => utile pour le profil public
        // pour le compte client => il faudra toutes les infos
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'pseudo' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'departement' => 'required|max:3'
        ]);

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
     * Remove the specified resource from storage.
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
