<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = ['text','type'];

    public function component(){
        return $this->hasOne(Component::class);
    }
}
