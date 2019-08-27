<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
   protected $table='button';

    public $timestamps=false;

    protected $fillable = [];

    protected $casts=[];

}
