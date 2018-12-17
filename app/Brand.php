<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name'
    ];

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function stores(){
        return $this->hasMany('App\Store');
    }
}
