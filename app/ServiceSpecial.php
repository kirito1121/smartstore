<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSpecial extends Model
{
    protected $table = 'service_specials';

    protected $fillable = [
        'service_id', 'store_id', 'price', 'start_date', 'expiry_date', 'day_of_week','active','all'
    ];

    protected $casts = [
        'day_of_week' => 'JSON',
        'active' => 'boolean',
        'all' => 'boolean',
    ];

    protected $hidden = [
        'start_date', 'expiry_date', 'service_id', 'store_id',
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}
