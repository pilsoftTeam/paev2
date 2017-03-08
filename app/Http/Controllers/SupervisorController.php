<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\Perfiles;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function getRevisores()
    {
        $revisores = Perfiles::where('idRol', 4)->with('getUsers')->get();
        return response()->json($revisores, 200);
    }

    public function getProveedores()
    {
        $bodegas = Bodegas::orderBy('nombreProveedor', 'asc')->get();
        return response()->json($bodegas, 200);
    }
}
