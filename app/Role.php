<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Role extends Model
{
    protected $table='roles';

    //public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];


    public function permission()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function user()
    {
        return $this->hasMany('App\User','role_id');
    }
}
