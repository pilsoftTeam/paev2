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

    //Esta relacion es para mostrar la asignacion/revision al usuario revisor
    public function getChecklist()
    {
        return $this->hasOne('App\Checklists', 'id', 'idChecklist')->with('getItems');
    }
}
