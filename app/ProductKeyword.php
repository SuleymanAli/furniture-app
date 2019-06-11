<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKeyword extends Model
{
    public function productTranslation()
    {
    	return $this->belongsTo('App\ProductTranslation');
    }
}
