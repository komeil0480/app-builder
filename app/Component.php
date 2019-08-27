<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use App\Button;

class Component extends Model
{
    protected $table='component';

    //public $timestamps=false;

    protected $fillable = [];

    protected $casts=[
        'style' => 'array',
    ];

    public function content()
    {
    	
        return $this->hasOne('App\button','id','content_id');
    }

    public function layout()
    {
        return $this->belongsToMany('App\layout')->withPivot('priority');
    }
}
