<?php

namespace App\Http\Controllers;

use App\Bodegas;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function getRevisores()
    {
        return response()->json(pi());
    }

    public function getProveedores()
    {
        $bodegas = Bodegas::all();
        return response()->json($bodegas, 200);
    }
}
