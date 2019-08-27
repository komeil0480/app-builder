<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='pages';

    //public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];

    public function layout()
    {
        return $this->belongsToMany('App\Layout')->withPivot('priority')->OrderBy('priority');
    }
}
