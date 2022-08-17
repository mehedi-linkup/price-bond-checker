<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;


class HomeController extends Controller
{
    public function index() {
        $category = Category::with('product')->latest()->get();
        $product = Product::latest()->get();
        // $productCat = Product::with('category')->get();
        return view('pages.website.index', compact('category', 'product'));
    }
    
    public function submenu($id) {
        $subcategory = Subcategory::where('category_id', $id)->get();
        $category = Category::find($id);
        return view('pages.website.submenu', compact('category', 'subcategory'));
    }


    // subcategory id pass bellow
    public function product($id) {
        $subcategory = Subcategory::find($id); // subcategory id retrieve which the product contain
        $category = Category::where('id', $subcategory->category_id)->first();
        $product = Product::where('subcategory_id', $id)->get();
        return view('pages.website.product', compact('subcategory','product', 'category'));
    }

    public function productDetail($id) {
        $product = Product::find( $id);
        $subcategory = Subcategory::where('id', $product->subcategory_id)->first();
        $category = Category::where('id', $product->category_id)->first();
        return view('pages.website.product-detail', compact('product', 'subcategory', 'category'));
    }

    public function getSearchSuggestions($keyword)
    {
        $product = Product::select('name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $category = Category::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $subcategory = SubCategory::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $mergedArray = array_merge($product, $category, $subcategory);

        $search_results = [];

        foreach ($mergedArray as $sr) {
            $search_results[] = $sr['name'];
        }

        return response()->json($search_results);
    }

    public function productSearch()
    {
        if (request()->query('q')) {
            $categories = Category::all();
            $keyword = request()->query('q');
            $search_result = Product::Where('name', 'like', "%$keyword%")->get();

            return view('pages.website.search', compact('search_result', 'keyword','categories'));
        }

        return redirect()->back();
    }
}
