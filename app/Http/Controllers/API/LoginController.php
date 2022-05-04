<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\API\BaseController;

class LoginController extends BaseController
{
    /**
     * Handle an login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Laravel cherche si l'email existe et si le mdp en clair correspond à celui hashé 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

             // on récupère l'utilisateur 
            $authUser = User::find(Auth::user()->id); 

            // on lui crée un token (enregistré dans la table personnal_access_tokens)
            $success['token'] =  $authUser->createToken('LoginUser' . $authUser->id)->plainTextToken;
            $success['pseudo'] =  $authUser->pseudo;

            // on renvoie la réponse 
            return $this->sendResponse($success, 'User signed in');
            
        } else {
            // si échec de la connexion, on renvoie un message d'erreur
            return $this->sendError('Echec de la connexion.', ['error' => 'L\utilisateur n\'existe pas ou le mot de passe est incorrect']);
        }
    }
}
