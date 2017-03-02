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

    public function edit(Request $request)
    {
        Agrupaciones::where('id', $request->id)->update([
            'nombre' => $request->nombre
        ]);
        return response()->json(200);
    }

    public function delete($id)
    {

        Agrupaciones::where('id', $id)->update([
            'estado' => false
        ]);
        return response()->json(200);
    }
}
