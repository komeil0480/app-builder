<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';

    //public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];


    public function role()
    {
        return $this->belongsToMany('App\Role');
    }
}

