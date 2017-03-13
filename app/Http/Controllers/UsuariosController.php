<?php

namespace App\Http\Controllers;

use App\Perfiles;
use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function getUsers()
    {
        return response()->json(Perfiles::where('idRol', '!=', 1)->where('idRol', '!=', 2)->with('getUsers')->paginate());
    }
}
