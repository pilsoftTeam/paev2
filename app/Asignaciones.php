<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    protected $table = 'asignaciones';

    public function getRevisor()
    {
        return $this->hasOne('App\User', 'id', 'idRevisor');
    }

    public function getSupervisor()
    {
        return $this->hasOne('App\User', 'id', 'idAsignador');
    }

    public function getBodegas()
    {
        return $this->hasOne('App\Bodegas', 'id', 'idBodega');
    }

    public function getBodegasForEvaluaciones()
    {
        return $this->hasOne('App\Bodegas', 'id', 'idBodega')->with('getChecklist');
    }
}
