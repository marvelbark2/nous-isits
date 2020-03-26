<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mnotes extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ex_mnotes';
    public $timestamps = false;
    protected $guarded = [''];

    public function module()
    {
        return $this->belongsTo('App\mod', 'id_module', 'id_module');
    }
    public function status()
    {
        return $this->belongsTo('App\statut', 'statut_def', 'id');
    }
    public function student()
    {
        return $this->belongsTo('App\etudiant', 'id_inscription', 'id_inscription');
    }

}
