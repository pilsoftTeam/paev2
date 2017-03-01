<?php

namespace App\Http\Controllers;

use App\Agrupaciones;
use App\Evaluaciones;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{
    public function getEvaluaciones($id)
    {
        $data = [
            'evaluaciones' => Evaluaciones::where('idItem', $id)->get(),
            'agrupaciones' => Agrupaciones::where('idItem', $id)->with('getEvaluaciones')->get()
        ];

        return response()->json($data, 200);

    }

    public function createWithoutAgrupacion(Request $request)
    {
        $items = new Evaluaciones();
        $items->idItem = $request->idItem;
        $items->evaluacion = $request->nombre;
        $items->save();

        return response()->json(200);
    }
}
