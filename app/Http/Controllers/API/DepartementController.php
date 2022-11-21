<?php

namespace App\Http\Controllers\API;

use App\Models\Departement;

class DepartementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departement::all();
        return $this->sendResponse($departements, 'Départements récupérés avec succès');
    }
}
