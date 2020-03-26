<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gnote extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ex_gnotes';
}
