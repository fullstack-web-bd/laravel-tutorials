<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        // Modify and do something (Optional)

        // Database Insert/Update/Delete
        # Way 01
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        # Way 02
        // $data = [
        //     'name' => $request->name,
        // ];
        // Category::create($data);

        # Way 03
        // Category::create($request->all());

        // Session a success/error
        session()->flash('success', 'Category created successfully.');

        // return back();
        return redirect()->route('categories.create');
    }
}
