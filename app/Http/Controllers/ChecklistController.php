<?php

namespace App\Http\Controllers;

use App\Checklists;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklist = Checklists::where('estado', true)->get();

        return response()->json($checklist, 200);
    }

    public function create(Request $request)
    {
        $checklist = new Checklists();
        $checklist->nombre = $request->newChecklistName;
        $checklist->save();

        return response()->json(200);
    }

    public function edit(Request $request)
    {
        Checklists::where('id', $request->id)->update([
            'nombre' => $request->newChecklistName
        ]);
        return response()->json(200);
    }

    public function delete($id)
    {
        Checklists::where('id', $id)->update([
            'estado' => false
        ]);
        return response()->json(200);
    }
}
