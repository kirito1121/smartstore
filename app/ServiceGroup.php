<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    protected $table = 'service_groups';

    protected $fillable = [
        'name', 'parent_id', 'brand_id',
    ];
    protected $hidden = [
        'created_at','updated_at','brand_id'
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function serviceGroups()
    {
        return $this->hasMany(ServiceGroup::class, 'parent_id');
    }

    public function children()
    {
        return $this->serviceGroups()->with('children');
    }
}
