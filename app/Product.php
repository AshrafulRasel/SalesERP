<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
       return $this->belongsTo('App\Category');
    }
    public function unit(){
        return $this->belongsTo('App\Unit');
    }
    public function tax(){
        return $this->belongsTo('App\Tax');
    }

    public function additionalProduct(){
        return $this->hasMany('App\ProductSupplier');
    }

    public function sale(){
        return $this->hasMany('App\Sale');
    }

    public function invoice(){
        return $this->belongsToMany('App\Invoice');
    }
}
