<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enote extends Model
{
    public function mdl()
    {
        return $this->belongsTo('App\module', 'module_id', 'id');
    }
}
