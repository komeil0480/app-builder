<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Layout extends Model
{
    protected $table='layout';

    //public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];

    public function component()
    {
        return $this->belongsToMany('App\Component')->withPivot('priority')->OrderBy('priority');
    }
}
