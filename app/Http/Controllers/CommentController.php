<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductTranslation;
use App\Comment;
use Session;

class CommentController extends Controller
{
    // Authenticated Users Can Comment Product
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $this->validate($request, [
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment_content'=>'required|min:5|max:2000'
        ]);

        $productTranslation = ProductTranslation::find($product_id);

        $productTranslationSlug = $productTranslation->slug;

        $product = $productTranslation->product;

        $comment = new Comment;

        $comment->comment_content = $request->comment_content;

        $comment->user()->associate(auth()->user());
        $comment->product()->associate($product);

        $comment->save();

        Session::flash('success','Your Comment Was Added');

        return redirect()->route('product.show', $productTranslationSlug);
    }

    // Authenticated Users Can Delete His/Her Own Comment(s)
    // User Can Delete Comments Of ALL User Who Has Admin Role

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        $product_id = $comment->product->translation->first()->slug;

        Session::flash('success','Deleted Comment');

        return redirect()->back()->withSuccess('Comment Deleted');        
    }
}