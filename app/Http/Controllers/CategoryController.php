<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Storage;

class CategoryController extends Controller
{
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
            'image'  => 'image|nullable|max:1999'
        ]);

        // Store Data To The Database

        $category = new Category;

        $category->name = $request->name;

        // Save Our Image
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/category_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no-image.png';
        }

        $category->image = $fileNameToStore;

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
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/category_images', $fileNameToStore);
        }

        // Saving Data To The Database
        $category->name = $request->input('name');

        if ($request->hasFile('image')) {
            $category->image = $fileNameToStore;
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

        //Check if post exists before deleting
        // if (!isset($post)){
        //     return redirect('/posts')->with('error', 'No Post Found');
        // }

        // Check for correct user
        // if(auth()->user()->id !==$post->user_id){
        //     return redirect('/posts')->with('error', 'Unauthorized Page');
        // }

        // Delete To The Storage
        if($category->image != 'no-image.png'){
            // Delete Image
            Storage::delete('public/category_images/'.$category->image);
        }

        // Delete To The Database        
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category Removed');
    }
}
