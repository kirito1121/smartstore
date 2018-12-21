<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras';

    protected $fillable = [
        'name', 'once', 'active',
    ];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public function serviceOptions()
    {
        return $this->hasMany('App\ServiceOption');
    }

    public function extraOptions()
    {
        return $this->hasMany('App\ExtraOption');
    }

    public function storeOptions()
    {
        return $this->hasMany('App\StoreOption');
    }

    public function orderDetails()
    {
        return $this->belongsToMany('App\OrderDetail', 'order_detail_options', 'extra_id', 'order_detail_id')->withPivot('extra_name', 'extra_value', 'extra_price');
    }
}
