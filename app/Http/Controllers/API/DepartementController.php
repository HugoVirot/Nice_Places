<?php

namespace App\Http\Controllers\API;

use App\Models\Departement;
use Illuminate\Http\Request;

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
        return response()->json($departements);
    }

}
