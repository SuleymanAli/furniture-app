<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTranslation;

class MainController extends Controller
{
    public function show($slug){
        // Fetch From The DB Based On Slug
        $productTranslation = ProductTranslation::where('slug', '=', $slug)->first();

        // Return The View And Pass In The Product Translation Object
        return view('products.show', ['productTranslation' => $productTranslation]);
    }
}
