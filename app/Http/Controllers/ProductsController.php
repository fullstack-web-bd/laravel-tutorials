<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', compact('products'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        return view('products.category', compact('category'));
    }

    public function tag($id)
    {
        $tag = Tag::find($id);
        return view('products.tag', compact('tag'));
    }

    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();

        return view('products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        // Save the tags in pivot table

        // Edit mode
        // $product->tags()->sync($request->tags);

        if ($request->tags) {
            $product->tags()->attach($request->tags);
            // foreach ($request->tags as $tag_id) {
            //     $product->tags()->attach($tag_id);
            // }
        }

        session()->flash('success', 'Product added successfully.');
        return back();
    }
}
