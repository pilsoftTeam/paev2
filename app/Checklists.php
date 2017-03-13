<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklists extends Model
{
    protected $table = 'checklists';

    public function getItems()
    {
        return $this->hasMany('App\Items', 'idChecklist', 'id')->where('estado', true)->with('getAgrupaciones', 'getEvaluaciones');
    }
}
