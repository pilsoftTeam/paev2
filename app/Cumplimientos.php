<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cumplimientos extends Model
{
    protected $table = 'cumplimientos';


    public function getOpcionesCumplimientos()
    {
        return $this->hasMany('App\OpcionesCumplimiento', 'idCumplimiento', 'id');
    }
}
