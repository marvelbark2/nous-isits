<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $connection = 'mysql2';
    protected $table = 't_inscription';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'id_inscription';

}
