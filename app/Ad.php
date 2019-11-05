<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['name','status'];

    public function components(){
        return $this->belongsToMany(Component::class, 'ad_components', 'ad_id', 'component_id');
    }
}
