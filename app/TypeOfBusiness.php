<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfBusiness extends Model
{
    protected $table = 'type_of_businesses';

    protected $fillable = ['name'];
}
