<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

	public function translation()
	{
		return $this->hasMany('App\ProductTranslation');
	}
}
