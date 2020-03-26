<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    protected $connection = 'mysql2';
    protected $table = 't_inscription';
    protected $primaryKey = 'id_inscription';
    public function mnote()
    {
        return $this->hasMany('App\mnote', 'id_inscription', 'id_inscription');
    }
}
