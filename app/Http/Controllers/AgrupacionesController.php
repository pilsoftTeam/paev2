<?php

namespace App\Http\Controllers;

use App\Agrupaciones;
use Illuminate\Http\Request;

class AgrupacionesController extends Controller
{
    public function create(Request $request)
    {
        $agrupaciones = new Agrupaciones();

        $agrupaciones->idItem = $request->idItem;
        $agrupaciones->nombre = $request->nombre;
        $agrupaciones->save();

        return response()->json(200);
    }
}
