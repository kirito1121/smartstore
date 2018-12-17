<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraOption extends Model
{
    protected $table = 'extra_options';

    protected $fillable = [
        'name', 'extra_id',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function extra()
    {
        return $this->belongsTo('App\Extra', 'extra_id');
    }
}
