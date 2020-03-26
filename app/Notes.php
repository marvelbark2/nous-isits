<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = "notes";
    protected $guarded = [];
    public function prepa()
    {
        return $this->hasMany('App\Prepas', 'matiere_id', 'id');
    }

}
