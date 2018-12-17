<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'no', 'total', 'status', 'store_id', 'staff_id', 'user_id', 'type', 'parent_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function staff(){
        return $this->belongsTo('App\Staff','user_id');
    }

    public function orderDetails(){
        return $this->hasMany('App\OrderDetail');
    }

    // public function bills(){
    //     return $this->hasMany('App\Bill');
    // }

    public function bill(){
        return $this->hasOne('App\Bill');
    }

}
