<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['name','position_x','position_y','position_z','height','width'];
}
