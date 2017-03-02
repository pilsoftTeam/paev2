<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function index($id)
    {
        $items = Items::where('idChecklist', $id)->where('estado', true)->get();
        return response()->json($items, 200);
    }

    public function create(Request $request)
    {
        $items = new Items();
        $items->idChecklist = $request->idChecklist;
        $items->nombre = $request->name;
        $items->save();
        return response()->json(200);
    }

    public function edit(Request $request)
    {
        Items::where('id', $request->id)->update([
            'nombre' => $request->nombre
        ]);

        return response()->json(200);
    }

    public function delete($id)
    {
        Items::where('id', $id)->update([
            'estado' => false
        ]);
        return response()->json(200);
    }
}
