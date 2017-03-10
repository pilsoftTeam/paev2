<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodegas extends Model
{
    public function getChecklistName()
    {
        return $this->hasOne('App\Checklists', 'id', 'idChecklist');
    }

    public function getAsignacion()
    {
        return $this->hasOne('App\Asignaciones', 'idBodega', 'id')->with('getRevisor', 'getSupervisor');
    }
}
