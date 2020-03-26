<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prepa extends Model
{
    protected $guarded = [];
    public function matiere()
    {
        return $this->belongsTo('App\Notes', 'matiere_id', 'id');
    }
}
