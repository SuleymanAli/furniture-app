<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Session;
use Storage;

class CategoryController extends Controller
{
    /* This CategoryController Consist Of Admin Panel Category Area */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', ['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data

        $this->validate($request, [
            'name'  => 'required',
            'image'  => 'required|image|max:1999'
        ]);

        // Store Data To The Database

        $category = new Category;

        $category->name = $request->name;

        // Save Our Image
        if($request->hasFile('image')){

            $file = Input::file('image');

            $image = Image::make($file);

            Response::make($image->encode('jpeg'));
            
        } else {
            $fileNameToStore = 'no-image.png';
        }

        $category->image = $image;

        $category->save();

        Session::flash('success', 'Your Product Category Has Been Created Successfully');

        return redirect()->route('category.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get Category By ID
        $category = Category::find($id);

        // Validate Data
        if ($request->image != $category->image) {
            $this->validate($request, [
                'name'  => 'required',
                'image'  => 'image|nullable|max:1999'
            ]);
        } else {
            $this->validate($request, [
                'name'  => 'required',
            ]);
        }

        // Save Our Image
        if($request->hasFile('image')){
            $file = Input::file('image');

            $image = Image::make($file);

            Response::make($image->encode('jpeg'));
        }

        // Saving Data To The Database
        $category->name = $request->input('name');

        if ($request->hasFile('image')) {
            $category->image = $image;
        }

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // Delete To The Database        
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category Removed');
    }

    public function showCategoryImage($id)
    {
        $category = Category::find($id);

        $image = Image::make($category->image);

        $response = Response::make($image->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
