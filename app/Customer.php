<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function invoice(){
        return $this->hasMany('App\Invoice');
    }
}
