<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $casts = [
        'query' => 'array'
    ];
}
