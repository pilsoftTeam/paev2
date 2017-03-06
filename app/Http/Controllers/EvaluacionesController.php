<?php

namespace App\Http\Controllers;

use App\Agrupaciones;
use App\Cumplimientos;
use App\Evaluaciones;
use App\OpcionesCumplimiento;
use App\Prueba;
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
        $info = Evaluaciones::where('id', $id)->with('getCumplimientos')->get();

        return response()->json($info, 200);
    }

    public function getOpcionesCumplimiento()
    {
        $opciones = Cumplimientos::with('getOpcionesCumplimientos')->get();

        return response()->json($opciones, 200);
    }

    public function saveCumplimiento(Request $request)
    {

        $cumplimiento = new Cumplimientos();
        $cumplimiento->nombreCumplimiento = $request->titulo;
        $cumplimiento->save();
        $idCumplimiento = $cumplimiento->id;
        foreach ($request->opciones as $opcion) {
            $opcionesCumplimiento = new OpcionesCumplimiento();
            $opcionesCumplimiento->idCumplimiento = $idCumplimiento;
            $opcionesCumplimiento->titulo = $opcion['nombre'];
            $opcionesCumplimiento->valor = $opcion['valor'];
            $opcionesCumplimiento->save();
        }
        return response()->json(200);
    }

    public function deleteCumplimiento($id)
    {
        OpcionesCumplimiento::where('idCumplimiento', $id)->delete();
        Cumplimientos::destroy($id);

        return response()->json(200);
    }

    public function setCumplimientoEvaluacion(Request $request)
    {
        Evaluaciones::where('id', $request->evaluacion)->update([
            'idCumplimiento' => $request->cumplimiento
        ]);

        return response()->json(200);
    }
}
