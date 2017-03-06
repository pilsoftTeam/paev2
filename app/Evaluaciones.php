<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    protected $table = 'evaluaciones';

    public function getCumplimientos()
    {
        return $this->hasOne('App\Cumplimientos', 'id', 'idCumplimiento')->with('getOpcionesCumplimientos');
    }
}
