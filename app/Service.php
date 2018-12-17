<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name', 'price', 'price_promotion', 'all', 'time', 'index', 'unit_id', 'brand_id', 'service_group_id','hot'
    ];

    protected $hidden = [
        'created_at','updated_at','service_group_id'
    ];

    protected $casts = [
        'hot' => 'boolean',
        'all' => 'boolean',
    ];


    public function unit()
    {
        return $this->belongsTo('App\Unit', 'unit_id');
    }

    public function storeOptions()
    {
        return $this->hasMany('App\StoreOption');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function serviceGroup()
    {
        return $this->belongsTo('App\ServiceGroup', 'service_group_id');
    }

    public function serviceOptions()
    {
        return $this->hasMany('App\ServiceOption');
    }
    public function serviceSpecial()
    {
        return $this->hasMany('App\ServiceSpecial');
    }

    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favoriteable');
    }

}
