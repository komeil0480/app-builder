<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table='link';

    public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];
}
