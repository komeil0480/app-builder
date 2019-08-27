<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $table='text';

    public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];
}
