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
            'evaluaciones' => Evaluaciones::where('idItem', $id)->where('idAgrupacion', null)->where('estado', true)->get(),
            'agrupaciones' => Agrupaciones::where('idItem', $id)->with('getEvaluaciones')->where('estado', true)->get()
        ];

        return response()->json($data, 200);

    }

    public function create(Request $request)
    {
        $items = new Evaluaciones();
        $items->idItem = $request->idItem;
        $items->evaluacion = $request->nombre;
        $items->idAgrupacion = $request->idAgrupacion === '' ? null : $request->idAgrupacion;
        $items->save();

        return response()->json(200);
    }

    public function editEvaluacion(Request $request)
    {
        Evaluaciones::where('id', $request->id)->update([
            'evaluacion' => $request->evaluacion
        ]);

        return response()->json(200);
    }

    public function deleteEvaluacion($id)
    {
        Evaluaciones::where('id', $id)->update([
            'estado' => false
        ]);

        return response()->json(200);
    }

    public function getInfo($id)
    {
        $info = Evaluaciones::where('id', $id)->get();

        return response()->json($info, 200);
    }
}
