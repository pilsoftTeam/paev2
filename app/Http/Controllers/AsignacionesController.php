<?php

namespace App\Http\Controllers;

use App\Asignaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignacionesController extends Controller
{
    public function getSupervisorAsignaciones()
    {
        $asignaciones = Asignaciones::with('getRevisor', 'getSupervisor', 'getBodegas')->get();
        return response()->json($asignaciones, 200);
    }


    public function save(Request $request)
    {
        $asignacion = new Asignaciones();

        $asignacion->idRevisor = $request->idRevisor;
        $asignacion->idAsignador = Auth::user()->id;
        $asignacion->idSupervisorRevisor = null;
        $asignacion->idBodega = $request->idBodega;
        $asignacion->save();

        return response()->json(200);
    }


}
