<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    public function getAgrupaciones()
    {
        return $this->hasMany('App\Agrupaciones', 'idItem', 'id')->where('estado', true)->with('getEvaluaciones');
    }

    public function getEvaluaciones()
    {
        return $this->hasMany('App\Evaluaciones', 'idItem', 'id')
            ->where('estado', true)
            ->where('idAgrupacion', null)
            ->with('getCumplimientos');
    }
}
