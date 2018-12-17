<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreOption extends Model
{
    protected $table = 'store_options';

    protected $fillable = ['service_id', 'store_id', 'extra_id', 'action', 'service_option_id'];

    protected $hidden = [
        'store_id','created_at','updated_at'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function extra()
    {
        return $this->belongsTo('App\Extra', 'extra_id');
    }

    public function serviceOption()
    {
        return $this->belongsTo('App\ServiceOption', 'service_option_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}
