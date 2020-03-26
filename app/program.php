<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    public function produc()
    {
        return $this->belongsTo('App\Prog', 'pr_programmation_id', 'id');
    }
}
