<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    protected $guarded = [];
    protected $table = 'modules';
    public function note()
    {
        return $this->hasMany('App\enote', 'module_id', 'id');
    }
    public function mno()
    {
        return $this->hasMany('App\mnote', 'module_id', 'id');
    }
}
