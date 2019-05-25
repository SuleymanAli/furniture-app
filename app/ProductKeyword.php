<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKeyword extends Model
{
    public function product()
    {
    	return $this->belongsTo('App\ProductTranslation');
    }
}
