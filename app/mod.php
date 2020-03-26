<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ac_module';
    protected $primaryKey = 'id_module';
    public function mnote()
    {
        return $this->hasMany('App\mnote', 'id_module', 'id_module');
    }
}
