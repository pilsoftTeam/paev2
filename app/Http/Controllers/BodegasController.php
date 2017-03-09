<?php

namespace App\Http\Controllers;

use App\Bodegas;
use Illuminate\Http\Request;

class BodegasController extends Controller
{
    public function getBodegas($size)
    {
        $size === null ? $size = 15 : $size;
        $bodegas = Bodegas::orderBy('nombreProveedor', 'asc')->with('getChecklistName')->paginate($size);
        return response()->json($bodegas, 200);
    }

    public function getBodegasBySearch($search)
    {
        $bodegas = Bodegas::where('nombreProveedor', 'like', '%' . $search . '%')
            ->orWhere('direccionBodega', 'like', '%' . $search . '%')
            ->orWhere('licitacion', 'like', '%' . $search . '%')
            ->orWhere('region', 'like', '%' . $search . '%')
            ->orWhere('comuna', 'like', '%' . $search . '%')
            ->with('getChecklistName')
            ->paginate();
        return response()->json($bodegas, 200);
    }

    public function assignBodega(Request $request)
    {
        Bodegas::where('id', $request->idBodega)->update([
            'idChecklist' => $request->idChecklist
        ]);
        return response()->json(200);
    }

    public function deleteAssignmentBodega(Request $request)
    {
        Bodegas::where('id', $request->idBodega)->update([
            'idChecklist' => null
        ]);
        return response()->json(200);
    }
}
