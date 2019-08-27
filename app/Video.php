<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table='video';

    public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];
}
