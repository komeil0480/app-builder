<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table='picture';

    public $timestamps=false;

    protected $fillable = ['link'];

    protected $casts=[];
}
