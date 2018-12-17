<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    protected $table = 'service_options';

    protected $fillable = [
        'service_id', 'extra_id', 'value', 'price', 'default',
    ];

    protected $hidden = [
        'service_id', 'extra_id','created_at','updated_at'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function extra()
    {
        return $this->belongsTo('App\Extra', 'extra_id');
    }

    public function storeOptions()
    {
        return $this->hasMany('App\StoreOption');
    }
}
