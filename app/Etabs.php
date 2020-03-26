<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etabs extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ac_etablissement';
}
