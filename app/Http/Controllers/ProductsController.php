<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', compact('products'));
    }

    public function dbExamples()
    {
        // $lastProductId = DB::table('products')
        //     // ->where('id', '>', 1)
        //     ->limit(1)
        //     ->orderBy('id', 'desc')
        //     ->value('id');
        // dd($lastProductId);

        // $names = DB::table('products')
        //     ->pluck('name', 'id');
        // dd($names);
        // $count = DB::table('products')->where('id', '>', 1)->count();
        // // ->count();
        // ddd($count);

        // if(DB::table('users')->where('name', 'Akash2')->exists()) {
        //     dd('Found');
        // }

        // dd(DB::table('products')->sum('price'));

        // dd(DB::table('users')->select('name')->groupBy('name')->get());

        // $products = Product::all();
        // $sum = 0;
        // foreach ($products as $p) {
        //     $sum += $p->price;
        // }

        // $userIds = [1, 3];
        // dd(DB::table('users')->whereIn('id', $userIds)->get());
        // dd(DB::table('users')->where('id', 1)->orWhere('id', 3)->get());

        // $inserted = DB::table('products')->insert(
        //     [
        //         'name' => 'Simple 3',
        //         'category_id' => 9,
        //         'price' => 1000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'name' => 'Simple 4',
        //         'category_id' => 9,
        //         'price' => 1000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]
        // );

        // $insertedId = DB::table('products')->insertGetId(
        //     [
        //         'name' => 'Simple 4',
        //         'category_id' => 9,
        //         'price' => 1000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]
        // );

        // dd($insertedId);


        $query = DB::table('products', 'p')
                ->select(
                    'p.id',
                    'p.name',
                    'p.price',
                    'cat.name as category_name',
                    'cat.id as category_id'
                )
                ->join('categories AS cat', 'p.category_id', '=', 'cat.id');

        if (request()->s) {
            $query->where('p.name', 'LIKE', '%' . request()->s . '%');
            // $query->addSelect('p.created_at');
        }

        $products = $query->paginate(10);

        // Loop through products and get tags
        foreach ($products as $product) {
            $product->tags = DB::table('tags')
                ->select('tags.id', 'tags.name')
                ->join('product_tag', 'tags.id', '=', 'product_tag.tag_id')
                ->where('product_tag.product_id', $product->id)
                ->get();
        }

        return view('products.db', compact('products'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        // $category = DB::table('categories')->where('id', $id)->first();
        // $category = DB::table('categories')->find($id);
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
