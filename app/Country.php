<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    public function university(){
        return $this->hasMany(University::class,'country','id');
    }
}
