<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExEnotes extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ex_enotes';
    public $timestamps = false;
    protected $guarded = [''];
}
