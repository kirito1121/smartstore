<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    protected $fillable = [
        'no', 'amount', 'date_to_out', 'date_to_join', 'user_id', 'staff_id', 'order_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'staff_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
