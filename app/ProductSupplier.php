<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }


}
