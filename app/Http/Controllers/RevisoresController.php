<?php

namespace App\Http\Controllers;

use App\Asignaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisoresController extends Controller
{
    public function getRevisiones()
    {
        $revisiones = Asignaciones::where('idRevisor', Auth::user()->id)
            ->where('estado', '=', 'pendiente')
            ->with('getBodegasForEvaluaciones')
            ->get();

        return response()->json($revisiones, 200);
    }
}
