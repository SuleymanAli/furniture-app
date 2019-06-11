<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function keywords()
    {
    	return $this->hasMany('App\ProductKeyword');
    }
}
