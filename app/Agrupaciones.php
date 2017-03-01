<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agrupaciones extends Model
{
    protected $table = 'agrupaciones';

    public function getEvaluaciones()
    {
        return $this->hasMany('App\Evaluaciones', 'idAgrupacion', 'id');
    }
}
