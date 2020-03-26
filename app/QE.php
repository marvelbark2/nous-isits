<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Laravelista\Comments\Commenter;

class QE extends Model
{
    //use Filterable;
    use Commenter;

    protected $guarded = [];
    private static $whiteListFilter = ['*'];
    protected $table = "q_e_s";
    protected $casts = ['user_id'];
    public function matiere() {
        return $this->belongsTo('App\matiere', 'matiere_id');
      }
    public function comments()
    {
        return $this->morphMany("\Laravelista\Comments\Comment", 'commentable');
    }
}
