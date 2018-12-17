<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'no', 'price', 'quantity','note', 'status',  'reason', 'order_id', 'service_id','bill_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function service(){
        return $this->belongsTo('App\Service','service_id');
    }

    public function order(){
        return $this->belongsTo('App\Order','order_id');
    }

    public function bill(){
        return $this->belongsTo('App\Bill','bill_id');
    }
}
