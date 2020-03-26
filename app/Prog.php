<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prog extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'pr_programmation';
    protected $guarded = [''];
}
