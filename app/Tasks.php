<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $guarded = [''];

    public function matiere()
    {
        return $this->belongsTo('App\matiere', 'matiere_id', 'id');
    }
}
