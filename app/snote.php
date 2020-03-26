<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class snote extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ex_snotes';
    protected $guarded = [];
    public $timestamps = false;

    public function ins()
    {
        return $this->belongsTo('App\Inscription', 'id_inscription', 'id_inscription');
    }
    public function statuts()
    {
        return $this->belongsTo('App\statut', 'statut', 'id');
    }
}
