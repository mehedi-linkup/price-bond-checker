<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use DB;
use Image;

class CategoryController extends Controller
{
    
    public function index()
    {
        $category = Category::latest()->get();
        return view('pages.admin.categories', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:100',
            'image' => 'mimes:jpeg,png,jpg,gif,webp',
        ]);
        $imgName = '';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $nameGen = hexdec(uniqid());
            $imgExt = strtolower($image->getClientOriginalExtension());
            $imgName = $nameGen. '.' . $imgExt;
            $upLocation = 'uploads/category/';
            // $image->move($upLocation, $imgName);
            Image::make($image)->resize(768,768)->save($upLocation . $imgName);
            $lastImage = $upLocation . $imgName;
        }
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->image = $lastImage;
            $category->save();
            
            $notification=array(
                'message'=>'Category Created Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {

            $notification=array(
                'message'=>'Something went wrong',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::findOrFail($id);
        $category = Category::latest()->get();
        return view('pages.admin.categories', compact('category', 'categoryData'));
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
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'mimes:jpeg,png,jpg,gif,webp',
        ]);
        
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $image = $request->file('image');
            if($image) {
                $imageName = date('YmdHi').$image->getClientOriginalName();
                Image::make($image)->resize(768,768)->save('uploads/category/' . $imageName);
                if(file_exists($category->image) && !empty($category->image)) {
                    unlink($category->image);
                }
                $lastImage = 'uploads/category/'. $imageName;
                $category['image'] = $lastImage;
            }
            $category->save();

            $notification=array(
                'message'=>'Category Updated Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.categories')->with($notification);

        } catch (\Exception $e) {

            $notification=array(
                'message'=>'Something went wrong',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            if(file_exists($category->image) AND !empty($category->image)){
                unlink($category->image);
            }
            $category->delete();
        }
        $notification=array(
            'message'=>'Category Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
