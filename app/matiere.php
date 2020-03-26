<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matiere extends Model
{
    protected $guarded = [];
    public function qe()
    {
        return $this->hasMany('App\QE', 'matiere_id', 'id');
    }
}
