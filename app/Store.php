<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'name', 'brand_id',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function services()
    {
        return $this->belongsToMany('App\Service', 'store_options', 'store_id', 'service_id')->withPivot('action');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function storeOptions()
    {
        return $this->hasMany('App\StoreOption');
    }
    public function serviceSpecial()
    {
        return $this->hasMany('App\ServiceSpecial');
    }
}
