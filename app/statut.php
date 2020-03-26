<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statut extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'p_estatut';
    public function snote()
    {
        return $this->hasMany('App\snote', 'statut', 'id');
    }
    public function mnote()
    {
        return $this->hasMany('App\mnote', 'statut', 'id');
    }
}
