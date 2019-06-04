<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

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

	public function translationAll()
	{
		return $this->hasMany('App\ProductTranslation');
	}

	public function translation($language = null)
	{
		if ($language == null) {
			$language = App::getLocale();
		}

		return $this->hasMany('App\ProductTranslation')->where('language', '=', $language);
	}
}
